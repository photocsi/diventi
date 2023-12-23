<!--   INIZIO SEZIONE RITAGLIO IMMAGINE -->
<div class="accordion-item">
  <h2 class="accordion-header" id="headingTwo">
    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      RITAGLIO IMMAGINE
    </button>
  </h2>
  <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">

      <div class="row mb-3">
  
  <div class="col-sm-12">
    <label>Seleziona proporzione ritaglio</label>
    <select id="ratio" class="form-select" aria-label="Default select example">
      
      <option value="4/3O">6x8 Orizzontale</option>
      <option value="4/3V">6x8 Verticale</option>
      <option value="2/3O">6x9 Orizzontale</option>
      <option value="2/3V">6x9 Verticale</option>
    </select>
  </div>
</div>

      <div class="card">
<div class="card-body" style="align-self: center;">
<div class="row text-center ">
   

    <div class="row text-center ">
       <h5> Ritaglio </h5>
       <div class="col-md-5">
          <div class="btn-group btn-group-md">
             <button class="btn btn-primary btn-disable"  onclick="crop()">Imposta ritaglio</button> 
        </div>
    </div>
    
    <div class="col-md-2">  </div>

    <div class="col-md-5">
        <div class="btn-group btn-group-md">
            <button class="btn btn-primary btn-disable" id="cropImageBtn">Conferma ritaglio</button>
        </div>
    </div>


    </div>

</div>
</div> 


    </div>
  </div>
</div> </div> <!-- FINE SEZIONE RITAGLIO IMMAGINE -->