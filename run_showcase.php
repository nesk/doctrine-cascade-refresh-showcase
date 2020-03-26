<?php

require_once "bootstrap.php";

// Set up the entities

$user = (new User)->setName('user');
$project = (new Project)->setName('project')->setUser($user);

$entityManager->persist($user);
$entityManager->persist($project);
$entityManager->flush();

// Showcase: Refresh inverse side (user)

echo "\nREFRESH INVERSE SIDE (User)\n\n";

// Edit the entities

$user->setName('[draft] user');
$project->setName('[draft] project');
echo "    Draft user name: {$user->getName()}\n";
echo "    Draft project name: {$project->getName()}\n\n";

// Refresh the user to revert changes

$entityManager->refresh($user);
echo "    Reverted user name: {$user->getName()}\n";
echo "    Reverted project name: {$project->getName()}\n\n"; // The project name is not reverted

// Showcase: Refresh owning side (project)

echo "REFRESH OWNING SIDE (Project)\n\n";

// Edit the entities

$user->setName('[draft] user');
$project->setName('[draft] project');
echo "    Draft user name: {$user->getName()}\n";
echo "    Draft project name: {$project->getName()}\n\n";

// Refresh the project to revert changes

$entityManager->refresh($project);
echo "    Reverted user name: {$user->getName()}\n";
echo "    Reverted project name: {$project->getName()}\n";

// Clear the database

$entityManager->remove($project);
$entityManager->remove($user);
$entityManager->flush();
