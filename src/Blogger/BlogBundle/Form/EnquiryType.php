<?php
/**
 * Created by PhpStorm.
 * User: sanek
 * Date: 17.02.16
 * Time: 13:15
 */

// src/Blogger/BlogBundle/Form/EnquiryType.php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email', EmailType::class);
        $builder->add('subject');
        $builder->add('body', TextareaType::class);
        //$builder->add('Submit', SubmitType::class);
    }

    public function getBlockPrefix()
    {
        return 'contact';
    }
}

// Old version
//class EnquiryType extends AbstractType
//{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $builder->add('name');
//        $builder->add('email', 'email');
//        $builder->add('subject');
//        $builder->add('body', 'textarea');
//    }
//
//    public function getName()
//    {
//        return 'contact';
//    }
//}