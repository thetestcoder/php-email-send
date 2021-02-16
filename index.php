<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="post">
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input
                            type="text"
                            class="form-control"
                            name="email"
                            id="email">
                </div>
                <div class="mb-2">
                    <label for="subject" class="form-label">Subject</label>
                    <input
                            type="text"
                            class="form-control"
                            name="subject"
                            id="subject">
                </div>
                <div class="mb-2">
                    <label for="query" class="form-label">Query</label>
                    <textarea
                            name="query"
                            id="query"
                            class="form-control"></textarea>
                </div>
                <div class="d-grid mb-2">
                    <button
                            type="submit"
                            class="btn btn-primary"
                            name="submit"
                    >Send Mail
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php

if (isset($_POST['submit'])) {

    $name = sanitizeData($_POST['name']);
    $email = filterEmail($_POST['email']);
    $subject = sanitizeData($_POST['subject']);
    $query = sanitizeData($_POST['query']);

    if (checkAllInput($name, $subject, $query) || $email === null) {
        die("Form Data is Invalid");
    }

    $templateData = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'query' => $query
    ];

    $message = includes('mail-template.php', $templateData, false);

    $to = 'thetestcoder@gmail.com';

    $headers = "From: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


    mail($to, $subject, $message, $headers);
    echo "Thanks for Contacting Us";
}


function sanitizeData($data): string
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function filterEmail(string $email): ?string
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email) ? $email : null;
}

function checkAllInput(...$data): bool
{
    foreach ($data as $item) {
        if (empty($item)) {
            return true;
        } else {
            continue;
        }
    }
    return false;
}

function includes(string $file_path, array $data = [], bool $print = true)
{
    $opt = null;
    if (file_exists($file_path)) {
        ob_start();
        extract($data);
        include $file_path;
        $opt = ob_get_clean();
    }
    if ($print)
        print $opt;
    else
        return $opt;
}
