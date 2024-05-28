<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(name: 'create:project')]
class CreateProjectCommand extends Command
{
    protected static $defaultName = 'create:project';
  

    protected function configure()
    {
        $this
            ->setDescription('Crée un nouveau projet')
            ->setHelp('Cette commande permet de créer un nouveau projet avec la structure de base...')
            ->addArgument('name', InputArgument::REQUIRED, 'Le nom du projet');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln('Création du projet ' . $name);

        // Demande le type de projet
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'What type of project do you want to create?',
            ['API', 'Module', 'Web or E-commerce'],
            0
        );
        $question->setErrorMessage('Type invalide.');

        $type = $helper->ask($input, $output, $question);
        $output->writeln('You have selected: ' . $type);

        // Création des dossiers spécifiques au type de projet
        $directories = $this->getDirectories($type);

        foreach ($directories as $dir) {
            if (!is_dir($name . $dir)) {
                mkdir($name . $dir, 0777, true);
            }
        }

        // Création des fichiers spécifiques
        $this->createFiles($type, $name, $output);

        $output->writeln('Project ' . $name . ' created!');
        return Command::SUCCESS;
    }

    private function getDirectories(string $type): array
    {
        $directoriesWeb = [
            '/src',
            '/src/Ressources',
            '/src/Ressources/Controller',
            '/src/Ressources/Entity',
            '/src/Ressources/Repository',
            '/src/Ressources/Service',
            '/src/Ressources/View',
            '/src/Router',
            '/public',
            '/var',
            '/var/cache',
            '/var/logs'
        ];

        $directoriesApi = [
            '/src',
            '/src/Controller',
            '/src/Entity',
            '/src/Repository',
            '/src/Service',
            '/var',
            '/var/cache',
            '/var/logs'
        ];

        $directoriesModule = [
            '/src',
            '/src/Ressources',
            '/src/Ressources/Controller',
            '/src/Ressources/Entity',
            '/src/Ressources/Repository',
            '/src/Ressources/Service',
            '/src/Ressources/Template',
            '/var',
            '/var/cache',
            '/var/logs'
        ];

        return match ($type) {
            'API' => $directoriesApi,
            'Module' => $directoriesModule,
            'Web or E-commerce' => $directoriesWeb,
        };
    }

    private function createFiles(string $type, string $name, OutputInterface $output): void
    {
        switch ($type) {
            case 'API':
                $this->createApiFiles($name, $output);
                break;
            case 'Module':
                $this->createModuleFiles($name, $output);
                break;
            case 'Site web':
                $this->createWebFiles($name, $output);
                break;
        }
    }

    private function createApiFiles(string $name, OutputInterface $output): void
    {
        $controllerContent = <<<'EOT'
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    #[Route('/api', name: 'api_index')]
    public function index(): JsonResponse
    {
        return new JsonResponse(['message' => 'Welcome to the API!']);
    }
}
EOT;

        file_put_contents($name . '/src/Controller/DefaultController.php', $controllerContent);
        $output->writeln('Fichiers API créés.');
    }

    private function createModuleFiles(string $name, OutputInterface $output): void
    {
        $controllerContent = <<<'EOT'
<?php

namespace App\Ressources\Controller;

class ModuleController
{
    public function index()
    {
        // Module logic here
    }
}
EOT;

        file_put_contents($name . '/src/Ressources/Controller/ModuleController.php', $controllerContent);
        $output->writeln('Fichiers Module créés.');
    }

    private function createWebFiles(string $name, OutputInterface $output): void
    {
        $controllerContent = <<<'EOT'
<?php

namespace App\Ressources\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return new Response('<html><body>Welcome to your new website!</body></html>');
    }
}
EOT;

        file_put_contents($name . '/src/Ressources/Controller/DefaultController.php', $controllerContent);
        $output->writeln('Folder structure created.');
    }
}