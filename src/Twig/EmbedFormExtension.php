<?php


/**
 * @file
 * Contains \Drupal\embed_form\Twig\EmbedViewExtension.
 */

namespace Drupal\embed_form\Twig;


/**
 * Class EmbedFormExtension
 * Print a menu
 * @package Drupal\embed_view\Twig
 */
class EmbedFormExtension extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'embed_form';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('embed_form', [$this, 'embedForm'], [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('embed_contact_form', [$this, 'embedContactForm'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function embedForm($formId)
    {
        try {
            $form = \Drupal::formBuilder()->getForm($formId);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        return $form;
    }

    public function embedContactForm($formId)
    {
        try{
            $form = ContactForm::load($formId);
            $viewBuilder = \Drupal::entityManager()->getViewBuilder('contact_form');
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $viewBuilder->view($form);
    }    
}
