<?php
include_once '../../../../wp-load.php';
$theme_path = get_stylesheet_directory_uri();
?>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coolturalia</title>
    <link href="<?php echo $theme_path?>/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Metrophobic&family=Work+Sans:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
</head>
<body>
<style>
    form {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    label {
        width: 100px;
        font-size: 14px;
        font-family: Poppins;
        font-weight: bold;
        margin-right: 10px;
    }

    select, input:not([type="submit"]) {
        max-width: 200px;
        width: 100%;
        font-size: 14px;
        padding: 5px 10px;
        border: 2px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    input[type="submit"], button[type="submit"] {
        font-size: 14px;
        padding: 5px 10px;
        background-color: #25703e;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #43ac63;
    }
</style>

<div id="content-mobile">
    <header>
        <a href="<?php echo get_site_url();?>">
            <h1>Coolturalia</h1>
        </a>
        <div class="activeIcons">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="23" height="23" viewBox="0 0 256 256" xml:space="preserve">
                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                    <path d="M 45 3 c 7.785 0 14.118 6.333 14.118 14.118 v 6.139 c 0 7.785 -6.333 14.118 -14.118 14.118 c -7.785 0 -14.118 -6.333 -14.118 -14.118 v -6.139 C 30.882 9.333 37.215 3 45 3 M 45 0 L 45 0 c -9.415 0 -17.118 7.703 -17.118 17.118 v 6.139 c 0 9.415 7.703 17.118 17.118 17.118 h 0 c 9.415 0 17.118 -7.703 17.118 -17.118 v -6.139 C 62.118 7.703 54.415 0 45 0 L 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    <path d="M 55.094 45.846 c 11.177 2.112 19.497 12.057 19.497 23.501 V 87 H 15.409 V 69.347 c 0 -11.444 8.32 -21.389 19.497 -23.501 C 38.097 47.335 41.488 48.09 45 48.09 S 51.903 47.335 55.094 45.846 M 54.639 42.727 C 51.743 44.227 48.47 45.09 45 45.09 s -6.743 -0.863 -9.639 -2.363 c -12.942 1.931 -22.952 13.162 -22.952 26.619 v 17.707 c 0 1.621 1.326 2.946 2.946 2.946 h 59.29 c 1.621 0 2.946 -1.326 2.946 -2.946 V 69.347 C 77.591 55.889 67.581 44.659 54.639 42.727 L 54.639 42.727 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                </g>
            </svg>
            <a href="<?php echo $theme_path?>/HTML/options.php" id="optionsIcon">
                <div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
            </a>
        </div>
    </header>
    <main>
        <div id="containerAllEvents">

            <div id="containerAllEvents">
                <?php
                $events = (new CustomOA_Events_List)->get_customoa_events_list();
                $displayed_categories = array(); // initialize array to keep track of displayed categories

                foreach ($events as $event) {
                    $event_data = get_custom_event_data($event['uid']);
                    $category = !empty($event_data['customoa_event_category']) ? $event_data['customoa_event_category'] : $event['type-devenement']['label']['fr'];

                    if (!in_array($category, $displayed_categories)){
                        $displayed_categories[] = !empty($event_data['customoa_event_category']) ? $event_data['customoa_event_category'] : $event['type-devenement']['label']['fr'];
                    }
                }



                $selected_category = "";
                if ( isset($_GET['event_category']) && !empty($_GET['event_category']) ) {
                    $selected_category = rawurlencode($_GET['event_category']);
                }

                ?>
                <form method="GET">
                    <label for="event_category">Choose a category:</label>
                    <select name="event_category" id="event_category">
                        <?php
                        echo "<option value='all_events'>ALL</option>";
                        foreach ($displayed_categories as $category){
                            if($category == $_GET['event_category']){
                                echo "<option value='$category' selected>$category</option>";
                            } else {
                                echo "<option value='$category'>$category</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Submit">
                </form>

                <form method="GET" >
                    <label for="search_query">Search:</label>
                    <input type="text" id="search_query" name="search_query">
                    <button type="submit" name="search">Search</button>
                </form>



                <!--                --><?php    // THIS NEEDS TO BE DELETED (event_date messes up the new date selector and we don't need this anymore)
                //                if ( isset($_GET['event_date']) && !empty($_GET['event_date']) ) {
                //                    $date = new DateTime($_GET['event_date']);
                //                    $selected_date = $date->format('Y-m-d');
                //                }
                //                else $selected_date = date('Y-m-d');
                //
                //                ?>



                <form method="GET">
                    <label for="event_date2">Date:</label>
                    <select name="event_date2" id="event_date2">
                        <option value="" <?php echo (empty ($_GET['event_date2'])) ? 'selected' : ''; ?>>Select a date</option>
                        <option value="today_date" <?php echo ($_GET['event_date2'] == 'today_date') ? 'selected' : ''; ?>>Today</option>
                        <option value="tomorrow_date" <?php echo ($_GET['event_date2'] == 'tomorrow_date') ? 'selected' : ''; ?>>Tomorrow</option>;
                        <option value="this_week_date" <?php echo ($_GET['event_date2'] == 'this_week_date') ? 'selected' : ''; ?>>This Week</option>;
                        <option value="this_weekend_date" <?php echo ($_GET['event_date2'] == 'this_weekend_date') ? 'selected' : ''; ?>>This Weekend</option>;
                    </select>
                    <input type="submit" value="Submit">
                </form>


            </div>

            <div id="hotThisWeek" style="margin: 30px 10px;">
                <?php
                $events = (new CustomOA_Events_List)->get_customoa_events_list();

                foreach ($events as $event) {
                    $event_data = get_custom_event_data($event['uid']);
                    $event_visibility = get_option('customoa_event_'. $event['uid'] .'_visibility', 'visible');

                    if ( $event_visibility == 'hidden' )
                        continue;  // skip current event in this loop if the visibility is set to HIDDEN

                    $title = !empty($event_data['customoa_event_title']) ? $event_data['customoa_event_title'] : $event['title']['fr'];
                    $description = !empty($event_data['customoa_event_description']) ? $event_data['customoa_event_description'] : $event['description']['fr'];
                    $image = !empty($event_data['customoa_event_file']) ? CUSTOMOA_PLUGIN_URL . 'includes/images/' . $event_data['customoa_event_file'] : 'https://cibul.s3.amazonaws.com/'.$event['image']['filename'];
                    $duration = $event['dateRange']['fr'];
                    $category = !empty($event_data['customoa_event_category']) ? $event_data['customoa_event_category'] : $event['type-devenement']['label']['fr'];
                    $single_event_url = '/wp-content/themes/coolturalia-theme/HTML/specificEvent.php?uid=' . $event['uid'];
                    $begin_date = !empty($event['nextTiming']['begin']) ? date('Y-m-d', strtotime($event['nextTiming']['begin'])) : '';


                    if( isset( $_GET['event_category'] ) && ( $_GET['event_category'] == 'all_events' || $_GET['event_category'] == $category ) ) {
                        echo "<div class='eventsDetails'>";
                        echo "<div class=''>";
                        echo "<div class='eventCard'>";
                        echo "<a href='$single_event_url'>";
                        echo "<img class='item' src='$image' alt='$title'>";
                        echo "<h2 class='EventName'>$title</h2>";
                        echo "<span>$description</span>";
                        echo "<br>";
                        echo "<span><strong>Duration:</strong> $duration</span>";
                        echo "<br>";
                        echo "<span><strong>Next date:</strong> $begin_date</span>";
                        echo "<br>";
                        echo "<span><strong>Category:</strong> $category</span>";
                        echo "<br>";
                        echo "<br>";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }


                    if(isset($_GET['search_query']) && !empty($_GET['search_query'])){

                        $title_small_case = strtolower( $title );
                        $description_small_case = strtolower( $description );
                        $search_query_small_case = strtolower( $_GET['search_query'] );


                        if(str_contains($title_small_case, $search_query_small_case) || str_contains($description_small_case, $search_query_small_case)){
                            echo "<div class='eventsDetails'>";
                            echo "<div class=''>";
                            echo "<div class='eventCard'>";
                            echo "<a href='$single_event_url'>";
                            echo "<img class='item' src='$image' alt='$title'>";
                            echo "<h2 class='EventName'>$title</h2>";
                            echo "<span>$description</span>";
                            echo "<br>";
                            echo "<span><strong>Duration:</strong> $duration</span>";
                            echo "<br>";
                            echo "<span><strong>Next date:</strong> $begin_date</span>";
                            echo "<br>";
                            echo "<span><strong>Category:</strong> $category</span>";
                            echo "<br>";
                            echo "<br>";
                            echo "</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

//                    url parameter: event_date
//                    date format: 'Y-m-d'  (this is how it comes from the form)
                    if(isset($_GET['event_date2']) && !empty($_GET['event_date2']) && !empty($begin_date)){

                        $monday_this_week = strtotime( date('Y-m-d', strtotime('monday this week')));
                        $today_date = strtotime( date('Y-m-d') );
                        $tomorrow_date = strtotime( date('Y-m-d', strtotime('+1 day')));
                        $next_saturday = strtotime( date('Y-m-d', strtotime('next Saturday')));
                        $next_sunday = strtotime( date('Y-m-d', strtotime('next Sunday')));





//                        $search_date = strtotime($_GET['event_date']);
                        $event_date = strtotime($begin_date);

                        if ( $_GET['event_date2'] == 'today_date' )
                            $search_date = $today_date;
                        elseif ( $_GET['event_date2'] == 'tomorrow_date' )
                            $search_date = $tomorrow_date;

                        if( !empty( $search_date ) && $search_date == $event_date ){
                            echo "<div class='eventsDetails'>";
                            echo "<div class=''>";
                            echo "<div class='eventCard'>";
                            echo "<a href='$single_event_url'>";
                            echo "<img class='item' src='$image' alt='$title'>";
                            echo "<h2 class='EventName'>$title</h2>";
                            echo "<span>$description</span>";
                            echo "<br>";
                            echo "<span><strong>Duration:</strong> $duration</span>";
                            echo "<br>";
                            echo "<span><strong>Next date:</strong> $begin_date</span>";
                            echo "<br>";
                            echo "<span><strong>Category:</strong> $category</span>";
                            echo "<br>";
                            echo "<br>";
                            echo "</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }



                        if ( $_GET['event_date2'] == 'this_week_date' ) {
                            $first_search_date = $today_date;
                            $second_search_date = $next_sunday;
                        }

                        if ( !empty( $first_search_date ) && !empty( $second_search_date ) ) {
                            if ( $event_date >= $first_search_date && $event_date <= $second_search_date ) {
                                echo "<div class='eventsDetails'>";
                                echo "<div class=''>";
                                echo "<div class='eventCard'>";
                                echo "<a href='$single_event_url'>";
                                echo "<img class='item' src='$image' alt='$title'>";
                                echo "<h2 class='EventName'>$title</h2>";
                                echo "<span>$description</span>";
                                echo "<br>";
                                echo "<span><strong>Duration:</strong> $duration</span>";
                                echo "<br>";
                                echo "<span><strong>Next date:</strong> $begin_date</span>";
                                echo "<br>";
                                echo "<span><strong>Category:</strong> $category</span>";
                                echo "<br>";
                                echo "<br>";
                                echo "</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }





                        $event_date_range = explode(" - ", $event['dateRange']['fr']);
                        $start_event_date = strtotime($event_date_range[0]);
                        $end_event_date = strtotime($event_date_range[1]);

                        if ( $_GET['event_date2'] == 'this_weekend_date' ) {
                            if ( ( $next_saturday >= $start_event_date || $next_saturday <= $end_event_date ) || ( $next_sunday >= $start_event_date || $next_sunday <= $end_event_date ) ) {
                                $event_timings = $event['timings'];

                                foreach ( $event_timings as $event_timing ) {
                                    $start_date = strtotime( date('Y-m-d', strtotime($event_timing['begin'])));

                                    if ( $next_saturday == $start_date || $next_sunday == $start_date ) {
                                        echo "<div class='eventsDetails'>";
                                        echo "<div class=''>";
                                        echo "<div class='eventCard'>";
                                        echo "<a href='$single_event_url'>";
                                        echo "<img class='item' src='$image' alt='$title'>";
                                        echo "<h2 class='EventName'>$title</h2>";
                                        echo "<span>$description</span>";
                                        echo "<br>";
                                        echo "<span><strong>Duration:</strong> $duration</span>";
                                        echo "<br>";
                                        echo "<span><strong>Next date:</strong> $begin_date</span>";
                                        echo "<br>";
                                        echo "<span><strong>Category:</strong> $category</span>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "</a>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        break;
                                    }
                                }
                            }
                        }




                    }



                }
                ?>
            </div>
        </div>
        <div id="sticky">
            <button type="button"><a href="<?php echo $theme_path?>/HTML/when.php">When</a></button>
            <button type="button"><a href="<?php echo $theme_path?>/HTML/what.php">What</a></button>
            <button type="button"><a href="<?php echo $theme_path?>/HTML/where.php">Where</a></button>
        </div>
    </main>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="<?php echo $theme_path?>/gallery.js"></script>
</body>