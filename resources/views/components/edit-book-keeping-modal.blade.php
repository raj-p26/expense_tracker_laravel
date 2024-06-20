<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $id }}Label">Add {{ $type }}</h1>
            </div>
            <form class="needs-validation" novalidate method="post" action="{{ route('user.'.$type.'.add') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="financeType" class="form-label">{{ $type }} Type</label>
                        <input type="text" class="form-control" id="financeType" name="{{ $type }}_type" required value="{{ $bookKeepingType }}" />
                        <div class="invalid-feedback">
                            Please Enter a valid {{ $type }} Type.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="financeAmount" class="form-label">{{ $type }} Amount</label>
                        <input type="number" class="form-control" id="financeAmount" name="{{ $type }}_amount" min="0" required value="{{ $bookKeepingAmount }}" />
                        <div class="invalid-feedback">
                            Please Enter a valid {{ $type }} Amount.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="{{ $type }}_description" class="form-label">{{ $type }} Description</label>
                        <textarea name="{{ $type }}_description" class="form-control" placeholder="Optional" id="{{ $type }}_description" value="{{ $bookKeepingDescription }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="{{ $type }}_date" class="form-label">{{ $type }} Date</label>
                        <input type="date" name="{{ $type }}_date" id="{{ $type }}_date" class="form-control" required value="{{ $bookKeepingDate }}" />
                        <div class="invalid-feedback">
                            Please Enter the date of {{ $type }}.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add {{ $type }}</button>
                </div>
            </form>
        </div>
    </div>
</div>