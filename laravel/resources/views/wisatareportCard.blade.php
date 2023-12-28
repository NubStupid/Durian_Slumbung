@for ($i =1 ; $i <= count($wisataTGL) ; $i++)
    <tr class="">
        <td class="py-2 px-4 border-b text-center">{{$i}}</td>
        <td class="py-2 px-4 border border-gray-300 text-center">Sesi ke {{$wisata[$i-1]['sesi']}}</td>
        <td class="py-2 px-4 border border-gray-300 text-center">{{date_format(date_create($wisataTGL[$i-1]['tgl_dipesan']),'l, j F Y')}}</td>
        <td class="py-2 px-4 border-b text-center">{{$wisataTGL[$i-1]['qty']}}</td>
    </tr>
@endfor
