<?php

namespace App\Controller\Admin;

use App\Entity\MaterialV2;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MaterialV2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialV2::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
