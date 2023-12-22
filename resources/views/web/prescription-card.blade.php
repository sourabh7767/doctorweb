@forelse ($Prescriptions as $Prescription)
<div class="cardArea">
    <div class="cardBody" data-id="{{@$Prescription->id}}">
        <h6 class="titleTxt from_diagn">{{@$Prescription->name}}</h6>
        <p class="description from_objective">{{@$Prescription->description}}</p>
        {{-- <p class="description from_recomend">{{@$Prescription->recomend}}</p> --}}
    </div>
    <div class="d-flex align-items-center">
        <span class="editModal" data-bs-toggle="modal" data-bs-target="#editPrescription"><i class="las la-pen"></i></span><span class="crossValue"><i class="las la-times"></i></span>
    </div>
    {{-- <span class="crossValue"><i class="las la-times"></i></span> --}}
</div>

@empty
    
@endforelse