@forelse ($Prescriptions as $Prescription)
<div class="cardArea">
    <div class="cardBody" data-id="{{@$Prescription->id}}">
        <h6 class="titleTxt from_diagn">{{replaceWithDate(@$Prescription->name)}}</h6>
        <p class="description from_objective">{{replaceWithDate(@$Prescription->description)}}</p>
    </div>
</div>

@empty
    
@endforelse