<?php
if (isset($_POST['submit']) && $_POST['submit']) {
    echo 'Searching ' . $_POST['search_by'] . ' for ' . $_POST['search_term'] . ' with a value of ' . $_POST['search_value'] . '<br/><br/><br/>';;
    $tjson = file_get_contents('JsonStore/tickets.json');
    $ojson = file_get_contents('JsonStore/organizations.json');
    $ujson = file_get_contents('JsonStore/users.json');

    // Read JSON file
    if (isset($_POST['search_by'])) {
        $result_array = [];
        $result_arr = [];

        //Search Tickets
        if ($_POST['search_by'] == 'tickets') {
            $tjson_data = json_decode($tjson, true);
            foreach ($tjson_data as $item) {
                if ($_POST['search_term'] == 'tags' && $item['tags'] && is_array($item['tags'])) {
                    if (in_array($_POST['search_value'], $item['tags']) || in_array(ucfirst($_POST['search_value']), $item['tags'])) {
                        $result_array[] = $item;
                    }
                } elseif ($item[$_POST['search_term']] == $_POST['search_value']) {
                    $result_array[] = $item;
                }
                $result_arr['submitter_id'] = $item['submitter_id'];
                if (!empty($item['assignee_id'])) {
                    $result_arr['assignee_id'] = $item['assignee_id'];
                }
                if (!empty($item['organization_id'])) {
                    $result_arr['organization_id'] = $item['organization_id'];
                }

                if ($result_arr['submitter_id'] || $result_arr['assignee_id']) {
                    $ujson_data = json_decode($ujson, true);
                    foreach ($ujson_data as $item) {
                        if ($item['_id'] == $result_arr['submitter_id']) {
                            $result_array[0]['submitter_name'] = $item['name'];
                        }
                        if ($item['_id'] == $result_arr['assignee_id']) {
                            $result_array[0]['assignee_name'] = $item['name'];
                        }
                    }
                }

                if ($result_arr['organization_id']) {
                    $ojson_data = json_decode($ojson, true);

                    foreach ($ojson_data as $item) {
                        if ($item['_id'] == $result_arr['organization_id']) {
                            $result_array[0]['organization_name'] = $item['name'];
                        }
                    }
                }
            }
        }
        //Search Organizations
        if ($_POST['search_by'] == 'organizations') {
            $ojson_data = json_decode($ojson, true);
            foreach ($ojson_data as $item) {
                if ($item[$_POST['search_term']] == $_POST['search_value']) {
                    $result_array[] = $item;
                    /* else if ($_POST['search_term'] == 'tags' && $item['tags'] && is_array($item['tags']) || $_POST['search_term'] == 'domain_names' && $item['domain_names'] && is_array($item['domain_names'])) {
                    if ((in_array($_POST['search_value'], $item['tags']) || in_array(ucfirst($_POST['search_value']), $item['tags'])) || (in_array($_POST['search_value'], $item['domain_names']))) {
                        $result_array[] = $item;
                    }
                }*/
                    $result_arr['organization_id'] = $item['_id'];

                    if ($result_arr['organization_id']) {
                        $tjson_data = json_decode($tjson, true);
                        foreach ($tjson_data as $item) {
                            if (isset($item['organization_id'])) {
                                if ($item['organization_id'] == $result_arr['organization_id']) {
                                    $result_array[0]['ticket_subject'] = $item['subject'];
                                    $result_arr['assignee_id'] = $item['assignee_id'];
                                    if ($result_arr['assignee_id']) {
                                        $ujson_data = json_decode($ujson, true);
                                        foreach ($ujson_data as $item) {
                                            if ($item['_id'] == $result_arr['assignee_id']) {
                                                $result_array[0]['assignee_name'] = $item['name'];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //Search Users
        if ($_POST['search_by'] == 'users') {
            $ujson_data = json_decode($ujson, true);
            foreach ($ujson_data as $item) {
                if ($item[$_POST['search_term']] == $_POST['search_value']) {
                    $result_array[] = $item;
                    if (!empty($item['organization_id'])) {
                        $result_arr['organization_id'] = $item['organization_id'];
                    }
                    $result_arr['user_id'] = $item['_id'];

                    if ($result_arr['user_id']) {
                        $tjson_data = json_decode($tjson, true);

                        foreach ($tjson_data as $item) {
                            if (!empty($item['assignee_id'])) {
                                if ($item['assignee_id'] == $result_arr['user_id']) {
                                    $result_array[0]['assignee_ticket_subject'] = $item['subject'];
                                }
                            }
                            if (!empty($item['submitter_id'])) {
                                if ($item['submitter_id'] == $result_arr['user_id']) {
                                    $result_array[0]['submitted_ticket_subject'] = $item['subject'];
                                }
                            }
                        }
                    }
                    if ($result_arr['organization_id']) {
                        $ojson_data = json_decode($ojson, true);

                        foreach ($ojson_data as $item) {
                            if ($item['_id'] == $result_arr['organization_id']) {
                                $result_array[0]['organization_name'] = $item['name'];
                            }
                        }
                    }
                }
            }
        }

        foreach ($result_array as $key => $value) {
            foreach ($result_array[0] as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        echo $key . ' : ' . $val . '<br/>';
                    }
                } else {
                    echo $key . ' : ' . $value . '<br/>';
                }
            }

            echo '--------------------------------------<br/>';
        }
    }
}
