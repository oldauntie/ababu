<form method="POST" action="{{ route('clinics.owners.pets.update', [$clinic, $owner, $pet]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $pet->name }}" maxlength="100" required
                                    placeholder="{{ __('translate.name') }}">
                                <label for="name">{{ __('translate.name') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="previous_diseases" type="text"
                                    class="form-control @error('previous_diseases') is-invalid @enderror" name="previous_diseases"
                                    value="{{ $pet->previous_diseases }}" maxlength="100"
                                    placeholder="{{ __('translate.previous_diseases') }}">
                                <label for="previous_diseases">{{ __('translate.previous_diseases') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="surgery" type="text"
                                    class="form-control @error('surgery') is-invalid @enderror" name="surgery"
                                    value="{{ $pet->surgery }}" maxlength="100"
                                    placeholder="{{ __('translate.surgery') }}">
                                <label for="surgery">{{ __('translate.surgery') }}</label>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col text-center">
                                    <button type="submit"
                                        class="btn btn-outline-success btn-lg">{{ __('translate.save') }}</button>
                                </div>
                            </div>

                            

                        </form>