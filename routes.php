<?php

declare(strict_types=1);

$router->get("/journals", "OJS\Journals\JournalsController::getAll");
$router->post("/journals", "OJS\Journals\JournalsController::insert");
$router->group("/journals", function ($router) {
    $router->get("/{journal_id:number}", "OJS\Journals\JournalsController::get");
    $router->post("/{journal_id:number}", "OJS\Journals\JournalsController::update");
    $router->delete("/{journal_id:number}", "OJS\Journals\JournalsController::delete");
});

$router->get("/journal-settings", "OJS\JournalSettings\JournalSettingsController::getAll");
$router->post("/journal-settings", "OJS\JournalSettings\JournalSettingsController::insert");
$router->group("/journal-settings", function ($router) {
    $router->get("/{journal_setting_id:number}", "OJS\JournalSettings\JournalSettingsController::get");
    $router->post("/{journal_setting_id:number}", "OJS\JournalSettings\JournalSettingsController::update");
    $router->delete("/{journal_setting_id:number}", "OJS\JournalSettings\JournalSettingsController::delete");
});

$router->get("/sections", "OJS\Sections\SectionsController::getAll");
$router->post("/sections", "OJS\Sections\SectionsController::insert");
$router->group("/sections", function ($router) {
    $router->get("/{section_id:number}", "OJS\Sections\SectionsController::get");
    $router->post("/{section_id:number}", "OJS\Sections\SectionsController::update");
    $router->delete("/{section_id:number}", "OJS\Sections\SectionsController::delete");
});

$router->get("/section-settings", "OJS\SectionSettings\SectionSettingsController::getAll");
$router->post("/section-settings", "OJS\SectionSettings\SectionSettingsController::insert");
$router->group("/section-settings", function ($router) {
    $router->get("/{section_setting_id:number}", "OJS\SectionSettings\SectionSettingsController::get");
    $router->post("/{section_setting_id:number}", "OJS\SectionSettings\SectionSettingsController::update");
    $router->delete("/{section_setting_id:number}", "OJS\SectionSettings\SectionSettingsController::delete");
});

$router->get("/issues", "OJS\Issues\IssuesController::getAll");
$router->post("/issues", "OJS\Issues\IssuesController::insert");
$router->group("/issues", function ($router) {
    $router->get("/{issue_id:number}", "OJS\Issues\IssuesController::get");
    $router->post("/{issue_id:number}", "OJS\Issues\IssuesController::update");
    $router->delete("/{issue_id:number}", "OJS\Issues\IssuesController::delete");
});

$router->get("/issue-settings", "OJS\IssueSettings\IssueSettingsController::getAll");
$router->post("/issue-settings", "OJS\IssueSettings\IssueSettingsController::insert");
$router->group("/issue-settings", function ($router) {
    $router->get("/{issue_setting_id:number}", "OJS\IssueSettings\IssueSettingsController::get");
    $router->post("/{issue_setting_id:number}", "OJS\IssueSettings\IssueSettingsController::update");
    $router->delete("/{issue_setting_id:number}", "OJS\IssueSettings\IssueSettingsController::delete");
});

$router->get("/issue-galleys", "OJS\IssueGalleys\IssueGalleysController::getAll");
$router->post("/issue-galleys", "OJS\IssueGalleys\IssueGalleysController::insert");
$router->group("/issue-galleys", function ($router) {
    $router->get("/{galley_id:number}", "OJS\IssueGalleys\IssueGalleysController::get");
    $router->post("/{galley_id:number}", "OJS\IssueGalleys\IssueGalleysController::update");
    $router->delete("/{galley_id:number}", "OJS\IssueGalleys\IssueGalleysController::delete");
});

$router->get("/issue-galley-settings", "OJS\IssueGalleySettings\IssueGalleySettingsController::getAll");
$router->post("/issue-galley-settings", "OJS\IssueGalleySettings\IssueGalleySettingsController::insert");
$router->group("/issue-galley-settings", function ($router) {
    $router->get("/{galley_id:number}", "OJS\IssueGalleySettings\IssueGalleySettingsController::get");
    $router->post("/{galley_id:number}", "OJS\IssueGalleySettings\IssueGalleySettingsController::update");
    $router->delete("/{galley_id:number}", "OJS\IssueGalleySettings\IssueGalleySettingsController::delete");
});

$router->get("/issue-files", "OJS\IssueFiles\IssueFilesController::getAll");
$router->post("/issue-files", "OJS\IssueFiles\IssueFilesController::insert");
$router->group("/issue-files", function ($router) {
    $router->get("/{file_id:number}", "OJS\IssueFiles\IssueFilesController::get");
    $router->post("/{file_id:number}", "OJS\IssueFiles\IssueFilesController::update");
    $router->delete("/{file_id:number}", "OJS\IssueFiles\IssueFilesController::delete");
});

$router->get("/custom-issue-orders", "OJS\CustomIssueOrders\CustomIssueOrdersController::getAll");
$router->post("/custom-issue-orders", "OJS\CustomIssueOrders\CustomIssueOrdersController::insert");
$router->group("/custom-issue-orders", function ($router) {
    $router->get("/{custom_issue_order_id:number}", "OJS\CustomIssueOrders\CustomIssueOrdersController::get");
    $router->post("/{custom_issue_order_id:number}", "OJS\CustomIssueOrders\CustomIssueOrdersController::update");
    $router->delete("/{custom_issue_order_id:number}", "OJS\CustomIssueOrders\CustomIssueOrdersController::delete");
});

$router->get("/custom-section-orders", "OJS\CustomSectionOrders\CustomSectionOrdersController::getAll");
$router->post("/custom-section-orders", "OJS\CustomSectionOrders\CustomSectionOrdersController::insert");
$router->group("/custom-section-orders", function ($router) {
    $router->get("/{custom_section_order_id:number}", "OJS\CustomSectionOrders\CustomSectionOrdersController::get");
    $router->post("/{custom_section_order_id:number}", "OJS\CustomSectionOrders\CustomSectionOrdersController::update");
    $router->delete("/{custom_section_order_id:number}", "OJS\CustomSectionOrders\CustomSectionOrdersController::delete");
});

$router->get("/publications", "OJS\Publications\PublicationsController::getAll");
$router->post("/publications", "OJS\Publications\PublicationsController::insert");
$router->group("/publications", function ($router) {
    $router->get("/{publication_id:number}", "OJS\Publications\PublicationsController::get");
    $router->post("/{publication_id:number}", "OJS\Publications\PublicationsController::update");
    $router->delete("/{publication_id:number}", "OJS\Publications\PublicationsController::delete");
});

$router->get("/publication-galleys", "OJS\PublicationGalleys\PublicationGalleysController::getAll");
$router->post("/publication-galleys", "OJS\PublicationGalleys\PublicationGalleysController::insert");
$router->group("/publication-galleys", function ($router) {
    $router->get("/{galley_id:number}", "OJS\PublicationGalleys\PublicationGalleysController::get");
    $router->post("/{galley_id:number}", "OJS\PublicationGalleys\PublicationGalleysController::update");
    $router->delete("/{galley_id:number}", "OJS\PublicationGalleys\PublicationGalleysController::delete");
});

$router->get("/publication-galley-settings", "OJS\PublicationGalleySettings\PublicationGalleySettingsController::getAll");
$router->post("/publication-galley-settings", "OJS\PublicationGalleySettings\PublicationGalleySettingsController::insert");
$router->group("/publication-galley-settings", function ($router) {
    $router->get("/{publication_galley_setting_id:number}", "OJS\PublicationGalleySettings\PublicationGalleySettingsController::get");
    $router->post("/{publication_galley_setting_id:number}", "OJS\PublicationGalleySettings\PublicationGalleySettingsController::update");
    $router->delete("/{publication_galley_setting_id:number}", "OJS\PublicationGalleySettings\PublicationGalleySettingsController::delete");
});

$router->get("/subscription-types", "OJS\SubscriptionTypes\SubscriptionTypesController::getAll");
$router->post("/subscription-types", "OJS\SubscriptionTypes\SubscriptionTypesController::insert");
$router->group("/subscription-types", function ($router) {
    $router->get("/{type_id:number}", "OJS\SubscriptionTypes\SubscriptionTypesController::get");
    $router->post("/{type_id:number}", "OJS\SubscriptionTypes\SubscriptionTypesController::update");
    $router->delete("/{type_id:number}", "OJS\SubscriptionTypes\SubscriptionTypesController::delete");
});

$router->get("/subscriptions", "OJS\Subscriptions\SubscriptionsController::getAll");
$router->post("/subscriptions", "OJS\Subscriptions\SubscriptionsController::insert");
$router->group("/subscriptions", function ($router) {
    $router->get("/{subscription_id:number}", "OJS\Subscriptions\SubscriptionsController::get");
    $router->post("/{subscription_id:number}", "OJS\Subscriptions\SubscriptionsController::update");
    $router->delete("/{subscription_id:number}", "OJS\Subscriptions\SubscriptionsController::delete");
});

$router->get("/institutional-subscriptions", "OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::getAll");
$router->post("/institutional-subscriptions", "OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::insert");
$router->group("/institutional-subscriptions", function ($router) {
    $router->get("/{institutional_subscription_id:number}", "OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::get");
    $router->post("/{institutional_subscription_id:number}", "OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::update");
    $router->delete("/{institutional_subscription_id:number}", "OJS\InstitutionalSubscriptions\InstitutionalSubscriptionsController::delete");
});

$router->get("/institutional-subscription-ip", "OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::getAll");
$router->post("/institutional-subscription-ip", "OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::insert");
$router->group("/institutional-subscription-ip", function ($router) {
    $router->get("/{institutional_subscription_ip_id:number}", "OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::get");
    $router->post("/{institutional_subscription_ip_id:number}", "OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::update");
    $router->delete("/{institutional_subscription_ip_id:number}", "OJS\InstitutionalSubscriptionIp\InstitutionalSubscriptionIpController::delete");
});

$router->get("/queued-payments", "OJS\QueuedPayments\QueuedPaymentsController::getAll");
$router->post("/queued-payments", "OJS\QueuedPayments\QueuedPaymentsController::insert");
$router->group("/queued-payments", function ($router) {
    $router->get("/{queued_payment_id:number}", "OJS\QueuedPayments\QueuedPaymentsController::get");
    $router->post("/{queued_payment_id:number}", "OJS\QueuedPayments\QueuedPaymentsController::update");
    $router->delete("/{queued_payment_id:number}", "OJS\QueuedPayments\QueuedPaymentsController::delete");
});

$router->get("/completed-payments", "OJS\CompletedPayments\CompletedPaymentsController::getAll");
$router->post("/completed-payments", "OJS\CompletedPayments\CompletedPaymentsController::insert");
$router->group("/completed-payments", function ($router) {
    $router->get("/{completed_payment_id:number}", "OJS\CompletedPayments\CompletedPaymentsController::get");
    $router->post("/{completed_payment_id:number}", "OJS\CompletedPayments\CompletedPaymentsController::update");
    $router->delete("/{completed_payment_id:number}", "OJS\CompletedPayments\CompletedPaymentsController::delete");
});

