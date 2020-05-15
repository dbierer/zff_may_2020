<?php
namespace Market\Form;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\Factory as FormFactory;
use Laminas\Captcha\Image as ImageCaptcha;

class PostFormFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return $requestedName instance
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $categories = $container->get('global-categories');
        $combinedCategories = array_combine($categories, $categories);
        $expireDays = $container->get('market-expire-days');
        $captchaAdapter = new ImageCaptcha();
        $captchaAdapter->setWordlen(4)->setOptions($container->get('market-captcha-options'));
        $formConfig = $container->get('market-post-form-config');
        $formConfig['elements']['category']['spec']['options']['value_options'] = $combinedCategories;
        $formConfig['elements']['expires']['spec']['options']['value_options'] = $expireDays;
        $formConfig['elements']['captcha']['spec']['options']['captcha'] = $captchaAdapter;
        $formFactory = new FormFactory();
        return $formFactory->createForm($formConfig);
    }
}
