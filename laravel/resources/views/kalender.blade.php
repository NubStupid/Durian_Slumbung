<?php
        echo '<div class="calendar">';
        //kalender header
        echo '<div class="calendar-header">';
        echo '<span class="year" id="tahun">';
        echo '2023';
        echo '</span>';
        echo '<div class="month-picker">';
        echo '<button type="button" class="btn btn-no-outline" onclick="updateCalendar(' . "'Left'" . ')"><</button>';
        echo '<span id="bulan">September</span>';
        echo '<button type="button" class="btn btn-no-outline" onclick="updateCalendar(' . "'Right'" . ')">></button>';
        echo '</div>';
        echo '</div>';
        //batas kalender header
        $ctr = array_search($day, $days);
        //kalender body
        echo '<div class="calendar-body">';
        echo '<div class="calendar-week-day">';
        echo '<div>Mon</div>';
        echo '<div>Tue</div>';
        echo '<div>Wed</div>';
        echo '<div>Thu</div>';
        echo '<div>Fri</div>';
        echo '<div>Sat</div>';
        echo '<div>Sun</div>';
        echo '</div>';
        echo '<div class="calendar-day" id="kalender">';
        for($i = $prevMonth - $ctr + 1; $i <= $prevMonth; $i++) {
            echo '<div>';
            echo '<button type="button" class="btn custom-button" onclick="showBook(this)" disabled>' . $i . '</button>';
            echo '</div>';
        }
        for($i = 1; $i <= $lastDate; $i++) {
            $ctr++;
            echo '<div>';
            echo '<button type="button" class="btn custom-button" onclick="showBook(this)">' . $i . '</button>';
            echo '</div>';
        }
        for($i = 1; $ctr % 7 != 0; $i++) {
            $ctr++;
            echo '<div>';
            echo '<button type="button" class="btn custom-button" onclick="showBook(this)" disabled>' . $i . '</button>';
            echo '</div>';
        }
        echo '</div>'; #close calender body
        echo '</div>';  #close calender
        // echo '</body>'; #light
        echo '</div>'; #close col
        echo '</div>';
        echo '<div class="col" id="sesiOlahan">';
        echo '</div>';
    ?>
