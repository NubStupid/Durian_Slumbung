<div class="calendar">
    <div class="calendar-header">
        <span class="year" id="tahun">{{$thn}}</span>
        <div class="month-picker">
            @if($selisih != 0)
                <button type="button" class="btn btn-no-outline" onclick="updateCalendar('Left')"><</button>
            @endif
            <span id="bulan">{{$bln}}</span>
            @if($selisih != 2)
                <button type="button" class="btn btn-no-outline" onclick="updateCalendar('Right')">></button>
            @endif
        </div>
    </div>

    <div class="calendar-body">
        <div class="calendar-week-day">
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
            <div>Sun</div>
        </div>
        <div class="calendar-day" id="kalender">
            @for($i = $prevMonth - $ctr + 1; $i <= $prevMonth; $i++)
                <div>
                    <button type="button" class="btn custom-button" onclick="showBook(this)" disabled>{{$i}}</button>
                </div>
            @endfor
            @for($i = 1; $i <= $lastDay; $i++)
                @php
                    $ctr++;
                @endphp
                <div>
                    <button type="button" class="btn custom-button" onclick="showBook(this)">{{$i}}</button>
                </div>
            @endfor
            @for($i = 1; $ctr % 7 != 0; $i++)
                @php
                    $ctr++;
                @endphp
                <div>
                    <button type="button" class="btn custom-button" onclick="showBook(this)" disabled>{{$i}}</button>
                </div>
            @endfor
        </div>
    </div>
</div>
