<?php

namespace App\Form;

use App\Entity\Customer\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class CustomerCompanyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName', TextType::class, [
                "required" => true,
                "constraints" => new NotBlank()
            ])
            ->add('email')
            ->add('address')
            ->add('address2')
            ->add('zipCode')
            ->add('city')
            ->add('country', CountryType::class, [
                'data' => 'FR',
            ])
            ->add('phone')
            ->add('companyVatNumber')
            ->add('companyNumber')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
