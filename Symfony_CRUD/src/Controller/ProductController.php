<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;
use App\Entity\Products;


class ProductController extends AbstractController{
   

    #[Route('/', name: 'product.index')]
    public function index( Request $request, ProductsRepository $repository, EntityManagerInterface $em ): Response{
        
        $products = $repository->findAll();
        
        foreach( $products as $product ){
            #SGH01----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH01') {
                if($product->getLocation()=='Bloc2'||'Bloc3'||'Bloc4'||'Bloc5'||'Bloc6'||'Bloc7'||'Bloc9'){
                    $product->setLocationType('Dangereux');}
                if($product->getLocation()=='Bloc1'){$product->setLocationType('Sous conditions');}
                if($product->getLocation()=='Bloc8'){$product->setLocationType('Conforme');}
            }#1


         #SGH02----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH02') {
                if($product->getLocation()=='Bloc1'||'Bloc3'||'Bloc4'||'Bloc5'||'Bloc6'||'Bloc7'||'Bloc9'){
                    $product->setLocationType('Dangereux');}
                 if($product->getLocation()=='Bloc2'){$product->setLocationType('Conforme');}
                 if( $product->getLocation()=='Bloc8'){$product->setLocationType('Conforme');}
            }#2
           
           
           #SGH03----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH03'){
                if( $product->getLocation()=='Bloc1'||'Bloc2'||'Bloc8'||'Bloc5'||'Bloc6'||'Bloc7'||'Bloc9'){
                $product->setLocationType('Dangereux'); }
           
                if($product->getLocation()=='Bloc3'){$product->setLocationType('Conforme');}
                if($product->getLocation()=='Bloc4'){$product->setLocationType('Sous conditions');}
            }
        
          #SGH04----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH04'){ 
                if($product->getLocation()=='Bloc1'||'Bloc2'||'Bloc8'||'Bloc6'||'Bloc7'||'Bloc9'){
                    $product->setLocationType('Dangereux');
                 }
                if($product->getLocation()=='Bloc4'){$product->setLocationType('Conforme');}
                if( $product->getLocation()=='Bloc3'|| 'Bloc5'){$product->setLocationType('Sous conditions');}
            }
   
            #SGH05----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH05') {
                if($product->getLocation()=='Bloc1'||'Bloc2'||'Bloc3'){
                    $product->setLocationType('Dangereux');
                 }
                if( $product->getLocation()=='Bloc1'|| 'Bloc2'|| 'Bloc3'|| 'Bloc6'|| 'Bloc7'|| 'Bloc8'|| 'Bloc9'){$product->setLocationType('Sous conditions');}
            }
            #SGH06----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH06') {
                if($product->getLocation()=='Bloc1'||'Bloc2'||'Bloc3'||'Bloc4'){
                    $product->setLocationType('Dangereux');
                }
                if( $product->getLocation()=='Bloc6'||'Bloc7'||'Bloc8'||'Bloc9'){$product->setLocationType('Conforme');}
                if( $product->getLocation()== 'Bloc5'){$product->setLocationType('Sous conditions');}
            }
            #SGH07----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            
            if($product->getDangerIcon()=='SGH07'){
                if($product->getLocation()=='Bloc1'||'Bloc2'||'Bloc3'||'Bloc4'){
                    $product->setLocationType('Dangereux');
                }
                if( $product->getLocation()=='Bloc6'||'Bloc7'||'Bloc8'||'Bloc9'){$product->setLocationType('Conforme');}
                if( $product->getLocation()== 'Bloc5'){$product->setLocationType('Sous conditions');}
                }
  
                   
            #SGH08----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH08') {
                if($product->getLocation()=='Bloc3'||'Bloc4'){
                    $product->setLocationType('Dangereux');
                    }
                if( $product->getLocation()=='Bloc1'||'Bloc2'||'Bloc6'||'Bloc7'||'Bloc8'||'Bloc9'){$product->setLocationType('Conforme');}
                if($product->getLocation()== 'Bloc5'){$product->setLocationType('Sous conditions');}
         }
             #SGH09----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if($product->getDangerIcon()=='SGH09'){
                if( $product->getLocation()=='Bloc1'||'Bloc2'||'Bloc3'||'Bloc4'){
                    $product->setLocationType('Dangereux');
                }
            if($product->getLocation()=='Bloc6'||'Bloc7'||'Bloc8'||'Bloc9'){$product->setLocationType('Conforme');}
            if($product->getLocation()== 'Bloc5'){$product->setLocationType('Sous conditions');}
                
            }
        
        }#End Foreach
        return $this->render('product/index.html.twig',[
            'products' => $products
            ]);
    }


    #[Route('/product/{id}/edit', name:'product.edit', methods: ['GET','POST'])]
    public function edit(Products $product, Request $request, EntityManagerInterface $em){
        
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ){
            $em->flush();
            $this->addFlash('success','Le produit à bien été mis à jour');
            return $this->redirectToRoute('product.index');

        }
        return $this->render('product/edit.html.twig', [
            'product'=> $product ,
            'form'=> $form
        ]);

    }
    
    #[Route('product/create', name:'product.create')]
    public function create( Request $request, EntityManagerInterface $em){
        $product = new Products();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ){
            $em->persist($product);
            $em->flush();
            $this->addFlash('success',' le produit à bien été ajouté');
            return $this->redirectToRoute('product.index');

        }   
        return $this->render('Product/create.html.twig', [
            'form'=> $form
            ]);
    }
    #[Route('product{id}', name:'product.delete',methods: ['DELETE'])]
    public function delete(Products $product, EntityManagerInterface $em){

        $em->remove($product);
        $em->flush();
        $this->addFlash('success',' le produit à bien été supprimé');
        return $this->redirectToRoute('product.index');
    }

}