curl -X GET "localhost:8080/journals"

curl -X POST "localhost:8080/journals" -H 'Content-Type: application/json' -d'
{
  "current_issue_id": 2384,
  "enabled": 9100,
  "path": "Number already party seek provide other. Choice book would happy stock why. Tend bed act now.",
  "primary_locale": "Like policy system imagine. Recent increase third those TV truth.",
  "seq": 281.0
}
'

curl -X POST "localhost:8080/journals/2873" -H 'Content-Type: application/json' -d'
{
  "current_issue_id": 2384,
  "enabled": 9100,
  "journal_id": 2873,
  "path": "Number already party seek provide other. Choice book would happy stock why. Tend bed act now.",
  "primary_locale": "Like policy system imagine. Recent increase third those TV truth.",
  "seq": 281.0
}
'

curl -X GET "localhost:8080/journals/2873"

curl -X DELETE "localhost:8080/journals/2873"

# --

curl -X GET "localhost:8080/journal-settings"

curl -X POST "localhost:8080/journal-settings" -H 'Content-Type: application/json' -d'
{
  "journal_id": 9933,
  "locale": "Clear there week minute set ok film. Might whole leg answer traditional. Red see have to heavy.",
  "setting_name": "Benefit book write answer if. Campaign respond save sing over statement. Opportunity growth coach someone she require. Usually thing level even about half.",
  "setting_type": "According some white. Fill put not else.",
  "setting_value": "Increase attention yeah off ok sign all. Run again fund yet."
}
'

curl -X POST "localhost:8080/journal-settings/1124" -H 'Content-Type: application/json' -d'
{
  "journal_id": 9933,
  "journal_setting_id": 1124,
  "locale": "Clear there week minute set ok film. Might whole leg answer traditional. Red see have to heavy.",
  "setting_name": "Benefit book write answer if. Campaign respond save sing over statement. Opportunity growth coach someone she require. Usually thing level even about half.",
  "setting_type": "According some white. Fill put not else.",
  "setting_value": "Increase attention yeah off ok sign all. Run again fund yet."
}
'

curl -X GET "localhost:8080/journal-settings/1124"

curl -X DELETE "localhost:8080/journal-settings/1124"

# --

curl -X GET "localhost:8080/sections"

curl -X POST "localhost:8080/sections" -H 'Content-Type: application/json' -d'
{
  "abstract_word_count": 4218,
  "abstracts_not_required": 9178,
  "editor_restricted": 6680,
  "hide_author": 4586,
  "hide_title": 7534,
  "is_inactive": 7961,
  "journal_id": 8641,
  "meta_indexed": 9134,
  "meta_reviewed": 1147,
  "review_form_id": 2387,
  "seq": 367.97
}
'

curl -X POST "localhost:8080/sections/5603" -H 'Content-Type: application/json' -d'
{
  "abstract_word_count": 4218,
  "abstracts_not_required": 9178,
  "editor_restricted": 6680,
  "hide_author": 4586,
  "hide_title": 7534,
  "is_inactive": 7961,
  "journal_id": 8641,
  "meta_indexed": 9134,
  "meta_reviewed": 1147,
  "review_form_id": 2387,
  "section_id": 5603,
  "seq": 367.97
}
'

curl -X GET "localhost:8080/sections/5603"

curl -X DELETE "localhost:8080/sections/5603"

# --

curl -X GET "localhost:8080/section-settings"

curl -X POST "localhost:8080/section-settings" -H 'Content-Type: application/json' -d'
{
  "locale": "Middle leave claim me keep mean time debate. Have possible anyone.",
  "section_id": 1523,
  "setting_name": "Process really if east consider other maybe. Often picture be maybe environment. Lose good history million future.",
  "setting_type": "Final remember discover role lead boy kind. Draw quickly else student. Your why organization material.",
  "setting_value": "Loss drive he few first. Break who job loss indeed of. Always their staff attorney continue top professional."
}
'

curl -X POST "localhost:8080/section-settings/3932" -H 'Content-Type: application/json' -d'
{
  "locale": "Middle leave claim me keep mean time debate. Have possible anyone.",
  "section_id": 1523,
  "section_setting_id": 3932,
  "setting_name": "Process really if east consider other maybe. Often picture be maybe environment. Lose good history million future.",
  "setting_type": "Final remember discover role lead boy kind. Draw quickly else student. Your why organization material.",
  "setting_value": "Loss drive he few first. Break who job loss indeed of. Always their staff attorney continue top professional."
}
'

curl -X GET "localhost:8080/section-settings/3932"

curl -X DELETE "localhost:8080/section-settings/3932"

# --

curl -X GET "localhost:8080/issues"

curl -X POST "localhost:8080/issues" -H 'Content-Type: application/json' -d'
{
  "access_status": 1772,
  "date_notified": "2022-02-23",
  "date_published": "2022-02-05",
  "journal_id": 6756,
  "last_modified": "2022-02-24",
  "number": "Second avoid dream dinner their bit. Form dog between so improve natural some hundred. Tell on well get smile.",
  "open_access_date": "2022-02-08",
  "original_style_file_name": "Including shoulder involve deep rule effect speak system. Region far feel agency wide marriage.",
  "published": 8794,
  "show_number": 7230,
  "show_title": 6698,
  "show_volume": 1000,
  "show_year": 3700,
  "style_file_name": "Fly guess ground left require system. Weight figure threat government there. Line success argue training which true.",
  "url_path": "Ever style full modern. While include current reduce administration indeed.",
  "volume": 5724,
  "year": 5969
}
'

curl -X POST "localhost:8080/issues/3257" -H 'Content-Type: application/json' -d'
{
  "access_status": 1772,
  "date_notified": "2022-02-23",
  "date_published": "2022-02-05",
  "issue_id": 3257,
  "journal_id": 6756,
  "last_modified": "2022-02-24",
  "number": "Second avoid dream dinner their bit. Form dog between so improve natural some hundred. Tell on well get smile.",
  "open_access_date": "2022-02-08",
  "original_style_file_name": "Including shoulder involve deep rule effect speak system. Region far feel agency wide marriage.",
  "published": 8794,
  "show_number": 7230,
  "show_title": 6698,
  "show_volume": 1000,
  "show_year": 3700,
  "style_file_name": "Fly guess ground left require system. Weight figure threat government there. Line success argue training which true.",
  "url_path": "Ever style full modern. While include current reduce administration indeed.",
  "volume": 5724,
  "year": 5969
}
'

curl -X GET "localhost:8080/issues/3257"

curl -X DELETE "localhost:8080/issues/3257"

# --

curl -X GET "localhost:8080/issue-settings"

curl -X POST "localhost:8080/issue-settings" -H 'Content-Type: application/json' -d'
{
  "issue_id": 3035,
  "locale": "Training near hour itself. Ready first week Mr land laugh region. Our upon small including reach partner.",
  "setting_name": "Business adult goal student. Paper near practice local government.",
  "setting_type": "Leader our raise box central never. Study by bag worker charge. Most approach after catch themselves.",
  "setting_value": "Different ever Mr. Church wrong art more born positive. Citizen compare hear left garden his certain."
}
'

curl -X POST "localhost:8080/issue-settings/8273" -H 'Content-Type: application/json' -d'
{
  "issue_id": 3035,
  "issue_setting_id": 8273,
  "locale": "Training near hour itself. Ready first week Mr land laugh region. Our upon small including reach partner.",
  "setting_name": "Business adult goal student. Paper near practice local government.",
  "setting_type": "Leader our raise box central never. Study by bag worker charge. Most approach after catch themselves.",
  "setting_value": "Different ever Mr. Church wrong art more born positive. Citizen compare hear left garden his certain."
}
'

curl -X GET "localhost:8080/issue-settings/8273"

curl -X DELETE "localhost:8080/issue-settings/8273"

# --

curl -X GET "localhost:8080/issue-galleys"

curl -X POST "localhost:8080/issue-galleys" -H 'Content-Type: application/json' -d'
{
  "file_id": 8518,
  "issue_id": 2089,
  "label": "Carry among over perhaps include source month. Mind without author film single. Money defense Congress apply finally look.",
  "locale": "Play paper put news decade require shoulder little. Same mouth gas stop throw writer. Big her these ground skill.",
  "seq": 733.227054,
  "url_path": "Wish total detail plan single officer speak. Box see claim. Know support join fast eye data cover unit."
}
'

curl -X POST "localhost:8080/issue-galleys/6476" -H 'Content-Type: application/json' -d'
{
  "file_id": 8518,
  "galley_id": 6476,
  "issue_id": 2089,
  "label": "Carry among over perhaps include source month. Mind without author film single. Money defense Congress apply finally look.",
  "locale": "Play paper put news decade require shoulder little. Same mouth gas stop throw writer. Big her these ground skill.",
  "seq": 733.227054,
  "url_path": "Wish total detail plan single officer speak. Box see claim. Know support join fast eye data cover unit."
}
'

curl -X GET "localhost:8080/issue-galleys/6476"

curl -X DELETE "localhost:8080/issue-galleys/6476"

# --

curl -X GET "localhost:8080/issue-galley-settings"

curl -X POST "localhost:8080/issue-galley-settings" -H 'Content-Type: application/json' -d'
{
  "issue_galley_setting_id": 7324,
  "locale": "Travel next improve. Real heavy good teach investment school church. Win car president drug.",
  "setting_name": "Ten personal through. Issue physical style stage say.",
  "setting_type": "Particular guy production floor. Better probably agreement exist. Occur president grow.",
  "setting_value": "Certainly human at down member. Go dog those. Design involve computer military he prove radio current."
}
'

curl -X POST "localhost:8080/issue-galley-settings/8237" -H 'Content-Type: application/json' -d'
{
  "galley_id": 8237,
  "issue_galley_setting_id": 7324,
  "locale": "Travel next improve. Real heavy good teach investment school church. Win car president drug.",
  "setting_name": "Ten personal through. Issue physical style stage say.",
  "setting_type": "Particular guy production floor. Better probably agreement exist. Occur president grow.",
  "setting_value": "Certainly human at down member. Go dog those. Design involve computer military he prove radio current."
}
'

curl -X GET "localhost:8080/issue-galley-settings/8237"

curl -X DELETE "localhost:8080/issue-galley-settings/8237"

# --

curl -X GET "localhost:8080/issue-files"

curl -X POST "localhost:8080/issue-files" -H 'Content-Type: application/json' -d'
{
  "content_type": 6809,
  "date_modified": "2022-02-21",
  "date_uploaded": "2022-02-08",
  "file_name": "Business all clearly whatever. Thank modern ago knowledge difficult dream.",
  "file_size": 7798,
  "file_type": "Case sea force audience. Fast dog employee perhaps husband truth area professor.",
  "issue_id": 6099,
  "original_file_name": "Sign common get open. Candidate consumer rise heart region cold tough."
}
'

curl -X POST "localhost:8080/issue-files/5484" -H 'Content-Type: application/json' -d'
{
  "content_type": 6809,
  "date_modified": "2022-02-21",
  "date_uploaded": "2022-02-08",
  "file_id": 5484,
  "file_name": "Business all clearly whatever. Thank modern ago knowledge difficult dream.",
  "file_size": 7798,
  "file_type": "Case sea force audience. Fast dog employee perhaps husband truth area professor.",
  "issue_id": 6099,
  "original_file_name": "Sign common get open. Candidate consumer rise heart region cold tough."
}
'

curl -X GET "localhost:8080/issue-files/5484"

curl -X DELETE "localhost:8080/issue-files/5484"

# --

curl -X GET "localhost:8080/custom-issue-orders"

curl -X POST "localhost:8080/custom-issue-orders" -H 'Content-Type: application/json' -d'
{
  "issue_id": 3492,
  "journal_id": 218,
  "seq": 913.484
}
'

curl -X POST "localhost:8080/custom-issue-orders/6922" -H 'Content-Type: application/json' -d'
{
  "custom_issue_order_id": 6922,
  "issue_id": 3492,
  "journal_id": 218,
  "seq": 913.484
}
'

curl -X GET "localhost:8080/custom-issue-orders/6922"

curl -X DELETE "localhost:8080/custom-issue-orders/6922"

# --

curl -X GET "localhost:8080/custom-section-orders"

curl -X POST "localhost:8080/custom-section-orders" -H 'Content-Type: application/json' -d'
{
  "issue_id": 1072,
  "section_id": 7318,
  "seq": 22.0
}
'

curl -X POST "localhost:8080/custom-section-orders/2983" -H 'Content-Type: application/json' -d'
{
  "custom_section_order_id": 2983,
  "issue_id": 1072,
  "section_id": 7318,
  "seq": 22.0
}
'

curl -X GET "localhost:8080/custom-section-orders/2983"

curl -X DELETE "localhost:8080/custom-section-orders/2983"

# --

curl -X GET "localhost:8080/publications"

curl -X POST "localhost:8080/publications" -H 'Content-Type: application/json' -d'
{
  "access_status": 1946,
  "date_published": "2022-02-07",
  "last_modified": "2022-02-23",
  "primary_contact_id": 933,
  "section_id": 8416,
  "seq": 867.3,
  "status": 9934,
  "submission_id": 5148,
  "url_path": "Involve almost subject car. Question reach wide available degree color coach.",
  "version": 507
}
'

curl -X POST "localhost:8080/publications/9893" -H 'Content-Type: application/json' -d'
{
  "access_status": 1946,
  "date_published": "2022-02-07",
  "last_modified": "2022-02-23",
  "primary_contact_id": 933,
  "publication_id": 9893,
  "section_id": 8416,
  "seq": 867.3,
  "status": 9934,
  "submission_id": 5148,
  "url_path": "Involve almost subject car. Question reach wide available degree color coach.",
  "version": 507
}
'

curl -X GET "localhost:8080/publications/9893"

curl -X DELETE "localhost:8080/publications/9893"

# --

curl -X GET "localhost:8080/publication-galleys"

curl -X POST "localhost:8080/publication-galleys" -H 'Content-Type: application/json' -d'
{
  "is_approved": 3948,
  "label": "Against make down conference do.",
  "locale": "Painting million order beautiful. Car though next capital local ever.",
  "publication_id": 7679,
  "remote_url": "Purpose develop bill series. Next prove great coach choice want.",
  "seq": 533.59,
  "submission_file_id": 2382,
  "url_path": "Recognize sort almost. Heart trade fish staff make truth. Near compare evening."
}
'

curl -X POST "localhost:8080/publication-galleys/5076" -H 'Content-Type: application/json' -d'
{
  "galley_id": 5076,
  "is_approved": 3948,
  "label": "Against make down conference do.",
  "locale": "Painting million order beautiful. Car though next capital local ever.",
  "publication_id": 7679,
  "remote_url": "Purpose develop bill series. Next prove great coach choice want.",
  "seq": 533.59,
  "submission_file_id": 2382,
  "url_path": "Recognize sort almost. Heart trade fish staff make truth. Near compare evening."
}
'

curl -X GET "localhost:8080/publication-galleys/5076"

curl -X DELETE "localhost:8080/publication-galleys/5076"

# --

curl -X GET "localhost:8080/publication-galley-settings"

curl -X POST "localhost:8080/publication-galley-settings" -H 'Content-Type: application/json' -d'
{
  "galley_id": 3750,
  "locale": "Concern food community eat choose TV.",
  "setting_name": "Discuss think inside democratic despite explain ability. Over form every local pick art phone.",
  "setting_value": "Walk blue walk citizen skin else. Cell establish much send."
}
'

curl -X POST "localhost:8080/publication-galley-settings/4869" -H 'Content-Type: application/json' -d'
{
  "galley_id": 3750,
  "locale": "Concern food community eat choose TV.",
  "publication_galley_setting_id": 4869,
  "setting_name": "Discuss think inside democratic despite explain ability. Over form every local pick art phone.",
  "setting_value": "Walk blue walk citizen skin else. Cell establish much send."
}
'

curl -X GET "localhost:8080/publication-galley-settings/4869"

curl -X DELETE "localhost:8080/publication-galley-settings/4869"

# --

curl -X GET "localhost:8080/subscription-types"

curl -X POST "localhost:8080/subscription-types" -H 'Content-Type: application/json' -d'
{
  "cost": 420.0,
  "currency_code_alpha": "Window friend shoulder program strategy how. Director me describe main across. Today performance while kid.",
  "disable_public_display": 3517,
  "duration": 1267,
  "format": 9320,
  "institutional": 2947,
  "journal_id": 9529,
  "membership": 1841,
  "seq": 109.0
}
'

curl -X POST "localhost:8080/subscription-types/7163" -H 'Content-Type: application/json' -d'
{
  "cost": 420.0,
  "currency_code_alpha": "Window friend shoulder program strategy how. Director me describe main across. Today performance while kid.",
  "disable_public_display": 3517,
  "duration": 1267,
  "format": 9320,
  "institutional": 2947,
  "journal_id": 9529,
  "membership": 1841,
  "seq": 109.0,
  "type_id": 7163
}
'

curl -X GET "localhost:8080/subscription-types/7163"

curl -X DELETE "localhost:8080/subscription-types/7163"

# --

curl -X GET "localhost:8080/subscriptions"

curl -X POST "localhost:8080/subscriptions" -H 'Content-Type: application/json' -d'
{
  "date_end": "2022-02-08",
  "date_start": "2022-03-01",
  "journal_id": 6182,
  "membership": "Resource develop business nearly. Seat force girl brother top why value. Contain energy apply say actually.",
  "notes": "Wrong young final price debate. Five bad adult condition.",
  "reference_number": "Before billion fine do. Stand indeed bag recently give kind. Million sit thing member major guess.",
  "status": 8798,
  "type_id": 4001,
  "user_id": 7818
}
'

curl -X POST "localhost:8080/subscriptions/9052" -H 'Content-Type: application/json' -d'
{
  "date_end": "2022-02-08",
  "date_start": "2022-03-01",
  "journal_id": 6182,
  "membership": "Resource develop business nearly. Seat force girl brother top why value. Contain energy apply say actually.",
  "notes": "Wrong young final price debate. Five bad adult condition.",
  "reference_number": "Before billion fine do. Stand indeed bag recently give kind. Million sit thing member major guess.",
  "status": 8798,
  "subscription_id": 9052,
  "type_id": 4001,
  "user_id": 7818
}
'

curl -X GET "localhost:8080/subscriptions/9052"

curl -X DELETE "localhost:8080/subscriptions/9052"

# --

curl -X GET "localhost:8080/institutional-subscriptions"

curl -X POST "localhost:8080/institutional-subscriptions" -H 'Content-Type: application/json' -d'
{
  "domain": "Impact around place. Worker weight surface raise color today despite.",
  "institution_name": "Think enjoy reason relate stuff run. Bring often someone plant stuff relate quality.",
  "mailing_address": "Under fall fill investment. Look month camera.",
  "subscription_id": 9309
}
'

curl -X POST "localhost:8080/institutional-subscriptions/9514" -H 'Content-Type: application/json' -d'
{
  "domain": "Impact around place. Worker weight surface raise color today despite.",
  "institution_name": "Think enjoy reason relate stuff run. Bring often someone plant stuff relate quality.",
  "institutional_subscription_id": 9514,
  "mailing_address": "Under fall fill investment. Look month camera.",
  "subscription_id": 9309
}
'

curl -X GET "localhost:8080/institutional-subscriptions/9514"

curl -X DELETE "localhost:8080/institutional-subscriptions/9514"

# --

curl -X GET "localhost:8080/institutional-subscription-ip"

curl -X POST "localhost:8080/institutional-subscription-ip" -H 'Content-Type: application/json' -d'
{
  "ip_end": 9041,
  "ip_start": 2893,
  "ip_string": "Benefit though raise. Able player life bar five article she.",
  "subscription_id": 589
}
'

curl -X POST "localhost:8080/institutional-subscription-ip/4173" -H 'Content-Type: application/json' -d'
{
  "institutional_subscription_ip_id": 4173,
  "ip_end": 9041,
  "ip_start": 2893,
  "ip_string": "Benefit though raise. Able player life bar five article she.",
  "subscription_id": 589
}
'

curl -X GET "localhost:8080/institutional-subscription-ip/4173"

curl -X DELETE "localhost:8080/institutional-subscription-ip/4173"

# --

curl -X GET "localhost:8080/queued-payments"

curl -X POST "localhost:8080/queued-payments" -H 'Content-Type: application/json' -d'
{
  "date_created": "2022-02-24",
  "date_modified": "2022-02-09",
  "expiry_date": "2022-02-22",
  "payment_data": "Player will along fact. Respond cut mouth song. Power city billion radio candidate both."
}
'

curl -X POST "localhost:8080/queued-payments/3712" -H 'Content-Type: application/json' -d'
{
  "date_created": "2022-02-24",
  "date_modified": "2022-02-09",
  "expiry_date": "2022-02-22",
  "payment_data": "Player will along fact. Respond cut mouth song. Power city billion radio candidate both.",
  "queued_payment_id": 3712
}
'

curl -X GET "localhost:8080/queued-payments/3712"

curl -X DELETE "localhost:8080/queued-payments/3712"

# --

curl -X GET "localhost:8080/completed-payments"

curl -X POST "localhost:8080/completed-payments" -H 'Content-Type: application/json' -d'
{
  "amount": 617.5819934302,
  "assoc_id": 4433,
  "context_id": 1740,
  "currency_code_alpha": "Begin color ask area year word trade. Act child music share relate moment. Thousand option good recognize own top Congress write.",
  "payment_method_plugin_name": "Way lay everything executive performance. Food show recently finally situation. Approach moment bill Republican.",
  "payment_type": 2055,
  "timestamp": "2022-02-18",
  "user_id": 7565
}
'

curl -X POST "localhost:8080/completed-payments/5809" -H 'Content-Type: application/json' -d'
{
  "amount": 617.5819934302,
  "assoc_id": 4433,
  "completed_payment_id": 5809,
  "context_id": 1740,
  "currency_code_alpha": "Begin color ask area year word trade. Act child music share relate moment. Thousand option good recognize own top Congress write.",
  "payment_method_plugin_name": "Way lay everything executive performance. Food show recently finally situation. Approach moment bill Republican.",
  "payment_type": 2055,
  "timestamp": "2022-02-18",
  "user_id": 7565
}
'

curl -X GET "localhost:8080/completed-payments/5809"

curl -X DELETE "localhost:8080/completed-payments/5809"

# --

