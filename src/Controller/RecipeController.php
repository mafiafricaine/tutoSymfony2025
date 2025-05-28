<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\RecipeRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class RecipeController extends AbstractController
{
    #[Route(path: "/recette", name: "app_recipe_index")]
    public function index(Request $request, RecipeRepository $repository, EntityManagerInterface $em): Response{
        // return new Response("Bienvenue sur la page des recettes");
        $recipes = $repository->findAll();
        //permet d'afficher les recettes qui ont moins d'une durée donnée en paramètre
        // $recipes = $repository->findRecipeDurationLowerThan(60);
        // dump($recipes);

        //création d'une recette grace a l'entity manager
        // $recipe = new Recipe;
        // $recipe->setTitle('Omelette')
        //     ->setSlug('omelette')
        //     ->setContent('Prenez des oeufs, cassez les et ensuite battez les en rajoutant du sel.')
        //     ->setDuration(6)
        //     ->setCreatedAt(new DateTimeImmutable())
        //     ->setUpdatedAt(new DateTimeImmutable());
        // $em->persist($recipe); 
        // $em->flush(); 
        
        //Modification d'une recette (le titre)
        // $recipes[3]->setTitle("Omelette");
        // $em->flush();

        //Pour supprimer une recette 
        // $em->remove($recipes[4]);
        // $em->flush();

        //comment récuperer nos recettes sans appeler le RecipeRepository
        // $recipes = $em->getRepository(Recipe::class)->findAll();
        return $this->render('recipe/index.html.twig',[
            'recipes' => $recipes
        ]);
    }

    #[Route(path : "/recette/{slug}-{id}", name : "app_recipe_show", requirements: ['id'=> '\d+', 'slug'=> '[a-z0-9-]+'])]
    public function show(Request $request, string $slug, int $id, RecipeRepository $repository): Response{
        /*
        dd($request);
        dd($request->attributes->getInt("id"),$request->attributes->get("slug") );
        dd($slug, $id);
        return new Response("Bienvenue sur la page ". $request->query->get("recette", "des recettes"));
        return new Response("Recette numéro ". $id . " : " . $slug);
        return new JsonResponse([
            'id' => $id,
            'slug' => $slug
        ]);
        return $this->json([
            'id' => $id,
            'slug' => $slug
        ]);
        */
        // $recipe = $repository->findOneBy(['slug'=>$slug]);
        // dd($recipe);
        $recipe = $repository->find($id);
        // dump($recipe);
        if($recipe->getSlug() !== $slug){
            return $this->redirectToRoute('app_recipe_show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId() ]);
        }
        return $this->render('recipe/show.html.twig', [
            'recipe'=>$recipe,
            'user'=>[
                'firstname'=>"Julien",
                'lastname'=>"Dunia"
            ]
        ]);
    }

    #[Route(path: "/recette/{id}/edit", name: "app_recipe_edit")]
    public function edit(Recipe $recipe): Response{
        // dd($recipe);
        $form = $this->createForm(RecipeType::class, $recipe);
        return $this->render('recipe/edit.html.twig', [
            'recipe'=>$recipe,
            'monForm'=>$form
        ]);
    }
       

}
