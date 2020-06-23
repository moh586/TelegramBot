@forelse($data as $row)

    <tr @if($row->activated==0) class="bg-warning white" @endif  >
        @foreach($fields as $field)
            <td>
                @if($field=="lv"||$field=="created_at")
                    {{jdate('Y/m/d',strtotime($row->$field))}}
                @else
                    {{$row->$field}}
                @endif
            </td>
        @endforeach

        <td class="text-center" >
             <span class="dropdown">
                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5  open-left">
                    <a href="{{route('customer.edit',['id'=>$row->id])}}" class="dropdown-item">  {{__('message.user.edit')}} <i class="la la-edit"></i> </a>
                    <a href="{{route('customer.report',['id'=>$row->id])}}" class="dropdown-item">  {{__('message.customer.report')}} <i class="la la-file-excel-o"></i> </a>
                    <a data-val="{{$row->id}}" class="dropdown-item detaill"> @if($row->activated==0){{__('message.status.active')}} @else {{__('message.status.deactive')}} @endif <i class="la la-exclamation-circle"></i> </a>
               </span>
            </span>
            {{-- <button class="btn btn-primary btn-edit" data-href="{{route('customer.edit',['id'=>$customer->id])}}"><i class="ft-edit"></i></button>
             <button class="btn btn-primary btn-info" data-toggle="modal" data-target="#cus{{$customer->id}}"><i class="ft-info"></i></button>
             <button class="btn btn-icon btn-warning mr-1"  data-val="{{$customer->id}}"><i class="ft-info"></i></button>--}}
        </td>
    </tr>

@empty
    <tr><td colspan="{{count($fields)+1}}" >{{__('message.nocustomer')}}</td> </tr>
@endforelse

<tr class=" text-center"><td colspan="{{count($fields)+1}}" class="text-center">{{ $data->links() }}</td> </tr>