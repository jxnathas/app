<?php

namespace App\Controller;

use App\Entity\Cidadao;
use App\Form\CidadaoType;
use App\Repository\CidadaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CidadaoController extends AbstractController {
    #[Route('/', name: 'index')]
    public function index(
        CidadaoRepository $cidadaoRepository
    )
    : Response {

        return $this->render(
            'cidadao/index.html.twig',
            [
                'cidadaos' => $cidadaoRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/cidadao/adicionar", name="cidadao_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {   
        $msg = '';
        $cidadao = new Cidadao('','');
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $nis = $cidadao->getNis();
            $existe = $em->getRepository(Cidadao::class)->findOneBy(['nis' => $nis]);
            if (!$existe) {
                $em->persist($cidadao);
                $em->flush();
                $msg = "Cadastro realizado com sucesso!";
            } else {
                $msg = "Este NIS já está cadastrado.";
            }
        }
        $cidadao->setNome($form->get('nome')->getData());
        $data['titulo'] = 'CADASTRAR NOVA PESSOA';
        $data['form'] = $form;
        $data['msg'] = $msg;
        return $this->renderForm('cidadao/form.html.twig', $data);
    }
}