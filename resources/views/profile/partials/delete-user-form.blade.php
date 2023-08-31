  <div class="card-header">
      <h2 class="text-danger fw-medium">
          {{ __('Eliminar Cuenta') }}
      </h2>
  </div>
  <div class="card-body">
      <p class="card-text">
          {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}
      </p>

      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Eliminar cuenta
      </button>

        <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <form method="post" action="{{ route('profile.destroy') }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">
                              {{ __('¿Está seguro de que desea eliminar su cuenta?') }}</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <p class="text-danger-emphasis">
                              {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Introduce tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
                          </p>

                          <div class="form-group">
                              <x-input-label for="password" value="{{ __('Contraseña') }}" />
                              <x-text-input id="password" name="password" type="password"
                                  placeholder="{{ __('Password') }}" />
                              <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-danger bg-gradient">
                              {{ __('Eliminar Cuenta') }}</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
