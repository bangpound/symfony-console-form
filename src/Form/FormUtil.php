<?php

namespace Matthias\SymfonyConsoleForm\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ResolvedFormTypeInterface;

class FormUtil
{
    /**
     * @param FormInterface $form
     *
     * @return array
     */
    public static function typeAncestry(FormInterface $form)
    {
        $types = [];
        self::typeAncestryForType($form->getConfig()->getType(), $types);

        return $types;
    }

    /**
     * @param ResolvedFormTypeInterface|null $formType
     * @param array                          &$types
     */
    public static function typeAncestryForType(ResolvedFormTypeInterface $formType = null, array &$types)
    {
        if (!($formType instanceof ResolvedFormTypeInterface)) {
            return;
        }

        $types[] = $formType->getName();

        self::typeAncestryForType($formType->getParent(), $types);
    }

    /**
     * @param FormInterface $form
     * @param mixed         $type
     *
     * @return bool
     */
    public static function isTypeInAncestry(FormInterface $form, $type)
    {
        return in_array($type, self::typeAncestry($form));
    }

    /**
     * @param FormInterface $form
     *
     * @return string
     */
    public static function type(FormInterface $form)
    {
        return $form->getConfig()->getType()->getName();
    }

    /**
     * @param FormInterface $form
     *
     * @return string
     */
    public static function label(FormInterface $form)
    {
        return $form->getConfig()->getOption('label', $form->getName());
    }

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public static function isCompound(FormInterface $form)
    {
        return $form->getConfig()->getOption('compound');
    }
}
