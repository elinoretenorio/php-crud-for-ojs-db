<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", OJS\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Journals

$container->add("JournalsRepository", OJS\Journals\JournalsRepository::class)
    ->addArgument("Database");
$container->add("JournalsService", OJS\Journals\JournalsService::class)
    ->addArgument("JournalsRepository");
$container->add(OJS\Journals\JournalsController::class)
    ->addArgument("JournalsService");

// JournalSettings

$container->add("JournalSettingsRepository", OJS\JournalSettings\JournalSettingsRepository::class)
    ->addArgument("Database");
$container->add("JournalSettingsService", OJS\JournalSettings\JournalSettingsService::class)
    ->addArgument("JournalSettingsRepository");
$container->add(OJS\JournalSettings\JournalSettingsController::class)
    ->addArgument("JournalSettingsService");

// Sections

$container->add("SectionsRepository", OJS\Sections\SectionsRepository::class)
    ->addArgument("Database");
$container->add("SectionsService", OJS\Sections\SectionsService::class)
    ->addArgument("SectionsRepository");
$container->add(OJS\Sections\SectionsController::class)
    ->addArgument("SectionsService");

// SectionSettings

$container->add("SectionSettingsRepository", OJS\SectionSettings\SectionSettingsRepository::class)
    ->addArgument("Database");
$container->add("SectionSettingsService", OJS\SectionSettings\SectionSettingsService::class)
    ->addArgument("SectionSettingsRepository");
$container->add(OJS\SectionSettings\SectionSettingsController::class)
    ->addArgument("SectionSettingsService");

// Issues

$container->add("IssuesRepository", OJS\Issues\IssuesRepository::class)
    ->addArgument("Database");
$container->add("IssuesService", OJS\Issues\IssuesService::class)
    ->addArgument("IssuesRepository");
$container->add(OJS\Issues\IssuesController::class)
    ->addArgument("IssuesService");

// IssueSettings

$container->add("IssueSettingsRepository", OJS\IssueSettings\IssueSettingsRepository::class)
    ->addArgument("Database");
$container->add("IssueSettingsService", OJS\IssueSettings\IssueSettingsService::class)
    ->addArgument("IssueSettingsRepository");
$container->add(OJS\IssueSettings\IssueSettingsController::class)
    ->addArgument("IssueSettingsService");

// IssueGalleys

$container->add("IssueGalleysRepository", OJS\IssueGalleys\IssueGalleysRepository::class)
    ->addArgument("Database");
$container->add("IssueGalleysService", OJS\IssueGalleys\IssueGalleysService::class)
    ->addArgument("IssueGalleysRepository");
$container->add(OJS\IssueGalleys\IssueGalleysController::class)
    ->addArgument("IssueGalleysService");

// IssueGalleySettings

$container->add("IssueGalleySettingsRepository", OJS\IssueGalleySettings\IssueGalleySettingsRepository::class)
    ->addArgument("Database");
$container->add("IssueGalleySettingsService", OJS\IssueGalleySettings\IssueGalleySettingsService::class)
    ->addArgument("IssueGalleySettingsRepository");
$container->add(OJS\IssueGalleySettings\IssueGalleySettingsController::class)
    ->addArgument("IssueGalleySettingsService");

// IssueFiles

$container->add("IssueFilesRepository", OJS\IssueFiles\IssueFilesRepository::class)
    ->addArgument("Database");
$container->add("IssueFilesService", OJS\IssueFiles\IssueFilesService::class)
    ->addArgument("IssueFilesRepository");
$container->add(OJS\IssueFiles\IssueFilesController::class)
    ->addArgument("IssueFilesService");

// CustomIssueOrders

$container->add("CustomIssueOrdersRepository", OJS\CustomIssueOrders\CustomIssueOrdersRepository::class)
    ->addArgument("Database");
$container->add("CustomIssueOrdersService", OJS\CustomIssueOrders\CustomIssueOrdersService::class)
    ->addArgument("CustomIssueOrdersRepository");
$container->add(OJS\CustomIssueOrders\CustomIssueOrdersController::class)
    ->addArgument("CustomIssueOrdersService");

// CustomSectionOrders

$container->add("CustomSectionOrdersRepository", OJS\CustomSectionOrders\CustomSectionOrdersRepository::class)
    ->addArgument("Database");
$container->add("CustomSectionOrdersService", OJS\CustomSectionOrders\CustomSectionOrdersService::class)
    ->addArgument("CustomSectionOrdersRepository");
$container->add(OJS\CustomSectionOrders\CustomSectionOrdersController::class)
    ->addArgument("CustomSectionOrdersService");

// Publications

$container->add("PublicationsRepository", OJS\Publications\PublicationsRepository::class)
    ->addArgument("Database");
$container->add("PublicationsService", OJS\Publications\PublicationsService::class)
    ->addArgument("PublicationsRepository");
$container->add(OJS\Publications\PublicationsController::class)
    ->addArgument("PublicationsService");

// PublicationGalleys

$container->add("PublicationGalleysRepository", OJS\PublicationGalleys\PublicationGalleysRepository::class)
    ->addArgument("Database");
$container->add("PublicationGalleysService", OJS\PublicationGalleys\PublicationGalleysService::class)
    ->addArgument("PublicationGalleysRepository");
$container->add(OJS\PublicationGalleys\PublicationGalleysController::class)
    ->addArgument("PublicationGalleysService");

// PublicationGalleySettings

$container->add("PublicationGalleySettingsRepository", OJS\PublicationGalleySettings\PublicationGalleySettingsRepository::class)
    ->addArgument("Database");
$container->add("PublicationGalleySettingsService", OJS\PublicationGalleySettings\PublicationGalleySettingsService::class)
    ->addArgument("PublicationGalleySettingsRepository");
$container->add(OJS\PublicationGalleySettings\PublicationGalleySettingsController::class)
    ->addArgument("PublicationGalleySettingsService");

// SubscriptionTypes

$container->add("SubscriptionTypesRepository", OJS\SubscriptionTypes\SubscriptionTypesRepository::class)
    ->addArgument("Database");
$container->add("SubscriptionTypesService", OJS\SubscriptionTypes\SubscriptionTypesService::class)
    ->addArgument("SubscriptionTypesRepository");
$container->add(OJS\SubscriptionTypes\SubscriptionTypesController::class)
    ->addArgument("SubscriptionTypesService");

// Subscriptions

$container->add("SubscriptionsRepository", OJS\Subscriptions\SubscriptionsRepository::class)
    ->addArgument("Database");
$container->add("SubscriptionsService", OJS\Subscriptions\SubscriptionsService::class)
    ->addArgument("SubscriptionsRepository");
$container->add(OJS\Subscriptions\SubscriptionsController::class)
    ->addArgument("SubscriptionsService");

// InstitutionalSubscriptions

$container->add("InstitutionalSubscriptionsRepository", OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsRepository::class)
    ->addArgument("Database");
$container->add("InstitutionalSubscriptionsService", OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsService::class)
    ->addArgument("InstitutionalSubscriptionsRepository");
$container->add(OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::class)
    ->addArgument("InstitutionalSubscriptionsService");

// InstitutionalSubscriptionIp

$container->add("InstitutionalSubscriptionIpRepository", OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpRepository::class)
    ->addArgument("Database");
$container->add("InstitutionalSubscriptionIpService", OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpService::class)
    ->addArgument("InstitutionalSubscriptionIpRepository");
$container->add(OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::class)
    ->addArgument("InstitutionalSubscriptionIpService");

// QueuedPayments

$container->add("QueuedPaymentsRepository", OJS\QueuedPayments\QueuedPaymentsRepository::class)
    ->addArgument("Database");
$container->add("QueuedPaymentsService", OJS\QueuedPayments\QueuedPaymentsService::class)
    ->addArgument("QueuedPaymentsRepository");
$container->add(OJS\QueuedPayments\QueuedPaymentsController::class)
    ->addArgument("QueuedPaymentsService");

// CompletedPayments

$container->add("CompletedPaymentsRepository", OJS\CompletedPayments\CompletedPaymentsRepository::class)
    ->addArgument("Database");
$container->add("CompletedPaymentsService", OJS\CompletedPayments\CompletedPaymentsService::class)
    ->addArgument("CompletedPaymentsRepository");
$container->add(OJS\CompletedPayments\CompletedPaymentsController::class)
    ->addArgument("CompletedPaymentsService");

