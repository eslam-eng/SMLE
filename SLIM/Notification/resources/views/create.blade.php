<div class="modal modal-blur fade" id="modal-add-notification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm">
                    @csrf
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-lg-6">
                               <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Notification Title">
                            </div>
                           </div>

                        </div>
                       <div class="row">
                       <div class="col-lg-12">
                           <div class="mb-3">
                               <label class="form-label">Notification</label>
                               <textarea class="form-control" name="notification" placeholder="Notification Description"></textarea>
                           </div>
                       </div>
                       </div>

                       <div class="modal-footer">
                        <a href="#" class="btn btn-danger link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" id="btnSubmit">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Save
                        </button>
                     </div>
                     </div>
                </form>
    </div>
    </div>
</div>

