<?php

namespace App\Controller;

use Gedmo\Loggable\Entity\LogEntry;
use App\Entity\Project;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auditoria')]
class AuditController extends AbstractController
{
    #[Route('/', name: 'app_audit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $logEntries = $entityManager->getRepository(LogEntry::class)
            ->findBy([], ['loggedAt' => 'DESC'], 50);

        return $this->render('audit/index.html.twig', [
            'log_entries' => $logEntries,
        ]);
    }

    #[Route('/proyecto/{id}', name: 'app_audit_project', methods: ['GET'])]
    public function projectAudit(Project $project, EntityManagerInterface $entityManager): Response
    {
        $logs = $entityManager->getRepository(LogEntry::class)
            ->findBy([
                'objectClass' => Project::class,
                'objectId' => $project->getId(),
            ], ['loggedAt' => 'DESC']);

        return $this->render('audit/project.html.twig', [
            'project' => $project,
            'logs' => $logs,
        ]);
    }

    #[Route('/empleado/{id}', name: 'app_audit_employee', methods: ['GET'])]
    public function employeeAudit(Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $logs = $entityManager->getRepository(LogEntry::class)
            ->findBy([
                'objectClass' => Employee::class,
                'objectId' => $employee->getId(),
            ], ['loggedAt' => 'DESC']);

        return $this->render('audit/employee.html.twig', [
            'employee' => $employee,
            'logs' => $logs,
        ]);
    }
}