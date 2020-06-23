

@forelse($customers as $customer)

    <tr @if($customer->activated==0) class="bg-warning white" @endif  >
        <td  class="text-center">
            {{$customer->getFullName()}}
        </td>
        <td  class="text-center">
            {{$customer->mobile}}
        </td>


        <td  class="text-center">
            <a href="mailto:{{$customer->email}}">{{$customer->email}}</a>
        </td>
        <td  class="text-center">
            {{$customer->score}}
        </td>
        <td  class="text-center">
            {{$customer->getLevel()->name}}
        </td>
        <td  class="text-center">
            {{$customer->getReagents()->count()}}
        </td>
        <td  class="text-center">
            {{jdate('Y/m/d',strtotime($customer->created_at))}}
        </td>
        <td  class="text-center">
            {{$customer->getBranch()->name}}
        </td>
        <td class="text-center" >

             <span class="dropdown">
                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5  open-left">
                    <a href="{{route('customer.edit',['id'=>$customer->id])}}" class="dropdown-item">  {{__('message.user.edit')}} <i class="la la-edit"></i> </a>
                    <a href="{{route('customer.report',['id'=>$customer->id])}}" class="dropdown-item">  {{__('message.customer.report')}} <i class="la la-file-excel-o"></i> </a>
                    <a data-toggle="modal" data-target="#cus{{$customer->id}}" class="dropdown-item "> {{__('message.customer.info')}} <i class="la la-info"></i> </a>
                    <a data-val="{{$customer->id}}" class="dropdown-item detaill"> @if($customer->activated==0){{__('message.status.active')}} @else {{__('message.status.deactive')}} @endif <i class="la la-exclamation-circle"></i> </a>
               </span>
            </span>
           {{-- <button class="btn btn-primary btn-edit" data-href="{{route('customer.edit',['id'=>$customer->id])}}"><i class="ft-edit"></i></button>
            <button class="btn btn-primary btn-info" data-toggle="modal" data-target="#cus{{$customer->id}}"><i class="ft-info"></i></button>
            <button class="btn btn-icon btn-warning mr-1"  data-val="{{$customer->id}}"><i class="ft-info"></i></button>--}}
        </td>
    </tr>

@empty
    <tr><td colspan="9" >{{__('message.nocustomer')}}</td> </tr>
@endforelse

<tr class=" text-center"><td colspan="9" class="text-center"> {{ $customers->links() }}</td> </tr>





