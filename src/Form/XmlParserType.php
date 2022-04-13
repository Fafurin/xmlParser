<?php

namespace App\Form;

use App\Entity\XmlParser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class XmlParserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('xmlFile', FileType::class, [
                'label' => 'XmlFile',
                'mapped' => false,
                'require' => false,
                'constrains' => [
                    new File([
                        'mimeTypes' => [
                            'application/xml'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid XML file',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => XmlParser::class,
        ]);
    }
}