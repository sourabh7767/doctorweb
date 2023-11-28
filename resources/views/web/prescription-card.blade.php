@forelse ($Prescriptions as $Prescription)
<div class="cardArea">
    <div class="cardBody" data-id="{{@$Prescription->id}}">
        <h6 class="titleTxt from_diagn">{{@$Prescription->name}}</h6>
        <p class="description from_objective">{{@$Prescription->description}}</p>
        {{-- <p class="description from_recomend">{{@$Prescription->recomend}}</p> --}}
    </div>
    <span class="crossValue"><i class="las la-times"></i></span>
</div>

@empty
    
@endforelse