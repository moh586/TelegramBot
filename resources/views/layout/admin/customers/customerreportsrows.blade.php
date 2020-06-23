@forelse($transactions as $transaction)
    <tr class="p-0">
        <td style="width: 1px" class="p-0 text-center width-5-per" width="5%">
            {{--<a class="danger delete "><i class="ft-trash-2"></i></a>--}}
            <a data-toggle="modal" data-value="{{$transaction->id}}" data-score="{{$transaction->score}}"
               data-operator="{{$transaction->getUser()->getFullName()}}" data-date=" {{jdate('Y/m/d',strtotime($transaction->created_at))}}"
               data-branch=" {{$transaction->getBranch()->name}}" data-target="#DeleteTransaction" class="danger delete"><i class="ft-trash-2"></i></a>
            <a data-toggle="modal" data-value="{{$transaction->id}}" data-score="{{$transaction->score}}"
               data-operator="{{$transaction->getUser()->getFullName()}}" data-date=" {{jdate('Y/m/d',strtotime($transaction->created_at))}}"
               data-branch=" {{$transaction->getBranch()->name}}" data-target="#EditTransaction" class="teal edit mr-1"><i class="ft-edit"></i></a> </td>
        <td  class="text-center p-0 width-10-per">
            {{$transaction->getBranch()->name}}
        </td>
        <td  class="text-center p-0 width-15-per">
            {{$transaction->getUser()->getFullName()}}
        </td>
        <td  class="text-center p-0" style="direction: ltr">
            {{$transaction->score}}
        </td>
        <td colspan="2" class="text-center  p-0">
            @if($transaction->description!="manual"){{$transaction->description}} @endif
        </td>
        <td  class="text-center p-0">
            {{jdate('Y/m/d',strtotime($transaction->created_at))}}
        </td>

    </tr>
@empty
    <tr><td class="text-center" colspan="7" >{{__('message.customer.notransaction')}}</td> </tr>
@endforelse

<tr class=" text-center"><td colspan="7" class="text-center"> {{ $transactions->links() }}</td> </tr>