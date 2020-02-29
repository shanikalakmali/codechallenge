<!DOCTYPE html>
<html>

<head>
    <title>Code Challenge by Shanika</title>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
    <form method="POST">
        <input type="radio" name="search_by" value="users" required>Users
        <input type="radio" name="search_by" value="tickets">Tickets
        <input type="radio" name="search_by" value="organizations">Organizations
        <input type="text" name="search_term" id="search_term" required placeholder="Enter search term" />
        <input type="text" name="search_value" id="search_value" placeholder="Enter search value" />
        <input type="submit" name="submit" id="submit" value="Submit" />
    </form>
    <a href="#" id="viewlist">View a list of searchable fields<br /><br /></a>
    <div id="list" style="display:none">
        -----------------------------------<br />
        Search Users with<br />
        _id<br />
        url<br />
        external_id<br />
        name<br />
        alias<br />
        created_at<br />
        active<br />
        verified<br />
        shared<br />
        local<br />
        timezone<br />
        last_login_at<br />
        email<br />
        phone<br />
        signature<br />
        organization_id<br />
        tags<br />
        suspended<br />
        role<br />
        -----------------------------------<br />
        Search Tickets with<br />
        _id<br />
        url<br />
        external_id<br />
        created_at<br />
        type<br />
        subject<br />
        description<br />
        priority<br />
        status<br />
        receipt<br />
        submitter_id<br />
        assignee_id<br />
        organization_id<br />
        tags<br />
        has_incidents<br />
        due_at<br />
        via<br />
        requester_id<br />
        -----------------------------------<br />
        Search Organizations with<br />
        _id<br />
        url<br />
        external_id<br />
        name<br />
        domain_names<br />
        created_at<br />
        details<br />
        shared_tickets<br />
        tags<br />
    </div>
</body>

</html>
<?php
include_once('functions.php');
?>