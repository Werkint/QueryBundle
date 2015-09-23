<?php
namespace Werkint\Bundle\QueryBundle\Service;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\UnsupportedFormatException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use JMS\Serializer\Exception\Exception as JMSSerializerException;
use Symfony\Component\Serializer\Exception\Exception as SymfonySerializerException;

/**
 * TODO: write "QueryParamConverter" info
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class QueryParamConverter implements
    ParamConverterInterface
{
    private $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @inheritdoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $context = DeserializationContext::create();
        $context->setGroups(['query']);

        try {
            $object = $this->serializer->deserialize(
                $request->attributes->get($configuration->getName()),
                $configuration->getClass(),
                'json',
                $context
            );
        } catch (UnsupportedFormatException $e) {
            throw new UnsupportedMediaTypeHttpException($e->getMessage(), $e);
        } catch (JMSSerializerException $e) {
            throw new BadRequestHttpException($e->getMessage(), $e);
        } catch (SymfonySerializerException $e) {
            throw new BadRequestHttpException($e->getMessage(), $e);
        }

        $request->attributes->set($configuration->getName(), $object);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function supports(ParamConverter $configuration)
    {
        return null !== $configuration->getClass();
    }
}