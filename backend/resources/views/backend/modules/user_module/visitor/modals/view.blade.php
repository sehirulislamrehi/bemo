<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> {{ $visitor->email }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
     <div class="row">
          <div class="col-sm-12">
               <table class="table table-bordered table-sm">
                    <tbody>
                         <tr>
                              <td>Name</td>
                              <td>{{ $visitor->name }}</td>
                         </tr>
                         <tr>
                              <td>Email</td>
                              <td>{{ $visitor->email }}</td>
                         </tr>

                         <tr>
                              <td>Created Date & Time</td>
                              <td>{{ $visitor->created_at->toDayDateTimeString() }}</td>
                         </tr>

                         <tr>
                              <td>Last Update</td>
                              <td>{{ $visitor->updated_at->toDayDateTimeString() }}</td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
