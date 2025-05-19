<div>
    <nav class="navbar shadow container p-3 color-nav rounded mt-2 d-flex justify-content-between">
          <button
            class="btn btn-outline-light d-flex aling-items-center justify-content-center px-2 rounded-5"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling"
            aria-controls="offcanvasScrolling"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              fill="currentColor"
              class="bi bi-list"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
              />
            </svg>
          </button>
    
          <div
            class="offcanvas offcanvas-start"
            data-bs-scroll="true"
            data-bs-backdrop="false"
            tabindex="-1"
            id="offcanvasScrolling"
            aria-labelledby="offcanvasScrollingLabel"
          >
            <div class="offcanvas-header mt-1">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <h5
                class="display-6 fw-bold text-center pb-3 text-sacramento color-text"
                id="offcanvasScrollingLabel"
              >
                Stock de Dina
              </h5>
              <a href="{{ route ('home')}}" class="text-decoration-none"
                ><h5 class="fs-4 ps-1 fw-bold enlaceMenu text-abril">HOME</h5></a
              >
              <hr / class="color-text border-2">
              <a href="{{ route ('producto.crear')}}" class="text-decoration-none"
                ><h5 class="fs-4 ps-1 fw-bold enlaceMenu text-abril">CREAR PRODUCTO</h5></a
              >
              {{-- <hr / class="color-text border-2">
              <a href="" class="text-decoration-none"
                ><h5 class="fs-4 ps-1 fw-bold enlaceMenu">COBROS</h5></a
              >
              <hr / class="color-text border-2">
              <a href="" class="text-decoration-none"
                ><h5 class="fs-4 ps-1 fw-bold enlaceMenu">JUEGOS</h5></a
              > --}}
              <hr / class="color-text border-2">
              <div class="position-absolute bottom-0 start-50 translate-middle-x mb-2 p-2">
                <div class="mb-2">
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-danger rounded-5 px-4 text-abril">
                          Cerrar sesión
                      </button>
                  </form>
                </div>
                <div class="d-none d-lg-block">
                  @if(session()->has('firebase_user_email'))
                      <span class="text-abril text-center p-2 text-body-secondary">{{ session('firebase_user_email') }}</span>
                  @endif
                </div>
              </div>
            
            </div>
          </div>
          <div class="ms-0 ms-md-4">
            <div class="ms-0 ms-md-5">
                  <img
                      src="/img/tacon.png"
                      alt="DinaCalzados"
                      class="rounded-circle"
                      width="40"
                      height="40"
                  />
                    <span class="text-abril fw-bold fs-5 fs-md-2">Stock de Dina</span>
              </div>
            </div>
            <div class="px-2 d-none d-md-block">
                @if(session()->has('firebase_user_email'))
                    <span class="text-white text-abril">{{ session('firebase_user_email') }}</span>
                @endif
            </div>
          
    </nav>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</div>