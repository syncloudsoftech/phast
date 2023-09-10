<?php

if (! defined('EXECUTION_ALLOWED')) {
    exit('Unauthorized access denied.');
}

use League\Plates\Engine;
use Medoo\Medoo;
use PHPMailer\PHPMailer\PHPMailer;

function create_mailer(): PHPMailer
{
    $mailer = new PHPMailer(true);
    $mailer->isSMTP();
    $mailer->Host = SMTP_HOST;
    $mailer->Port = SMTP_PORT;
    if (SMTP_USERNAME && SMTP_PASSWORD) {
        $mailer->SMTPAuth = true;
        $mailer->Username = SMTP_USERNAME;
        $mailer->Password = SMTP_PASSWORD;
    }

    $mailer->SMTPDebug = defined('DEBUG_ENABLED');
    $mailer->SMTPSecure = SMTP_ENCRYPTION;

    return $mailer;
}

function get_or_create_db(): Medoo
{
    static $database;
    if (empty($database)) {
        $database = new Medoo([
            'type' => 'mysql',
            'host' => DB_HOST,
            'port' => DB_PORT,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD,
            'database' => DB_NAME,
        ]);
    }

    return $database;
}

function migrate_database(): array
{
    $db = get_or_create_db();

    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `migrations` (
    `name` VARCHAR(255),
    PRIMARY KEY (`name`)
) ENGINE=InnoDB;
SQL;
    $db->exec($sql);

    $migrations = [];
    foreach (new DirectoryIterator(__DIR__.'/migrations') as $file) {
        $filename = $file->getFilename();
        if (strpos($filename, '.') !== 0) {
            $migrations[] = $filename;
        }
    }

    sort($migrations);

    $existing = array_column($db->select('migrations', ['name']), 'name');

    $missing = [];
    foreach ($migrations as $migration) {
        if (in_array($migration, $existing)) {
            continue;
        }

        $sql = file_get_contents(__DIR__.'/migrations/'.$migration);
        $db->exec($sql);

        $db->insert('migrations', ['name' => $migration]);
        $missing[] = $migration;
    }

    return $missing;
}

function render_template(string $name, array $data = []): string
{
    $engine = new Engine(__DIR__.'/templates');

    return $engine->render($name, $data);
}

/**
 * @param  array|object  $data
 */
function respond_with_json($data): void
{
    header('content-type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function respond_with_template(string $name, array $data = []): void
{
    echo render_template($name, $data);
}
