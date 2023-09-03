<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Encabezado -->
    <header class="navbar sticky-top bg-dark  p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-4 text-white bg-body-tertiary"
            href="{{ route('dashboard') }}">Libreria</a>

    </header>

    <!-- Contenido de la página -->
    <div class="container-fluid">
        <div class="row">
            <!-- navegacion -->
            @include('layouts.navigation')

            <!-- informacion -->
            <main class="col-md-9 ms-sm-auto col-lg-10 border border-dark-subtle bg-body-secondary ">
                {{ $slot }}


            </main>
        </div>
    </div>

    <!-- boton de cambio de tema -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 z-10">
        <button class="btn btn-success py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
            <i class=" theme-icon-active bi bi-brightness-high-fill"> </i>
            <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <i class="bi bi-brightness-high-fill me-2">
                    </i>
                    Light

                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="true">
                    <i class="bi bi-moon-fill me-2"> </i>
                    Dark
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto"
                    aria-pressed="false">
                    <i class="bi bi-circle-half me-2"></i>
                    Auto
                </button>
            </li>
        </ul>
        </li>

    </div>

    <!-- Scripts -->
    <script>
        (() => {
            "use strict";

            const getStoredTheme = () => localStorage.getItem("theme");
            const setStoredTheme = (theme) => localStorage.setItem("theme", theme);

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) {
                    return storedTheme;
                }

                return window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "dark" :
                    "light";
            };

            const setTheme = (theme) => {
                if (
                    theme === "auto" &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches
                ) {
                    document.documentElement.setAttribute("data-bs-theme", "dark");
                } else {
                    document.documentElement.setAttribute("data-bs-theme", theme);
                }
            };

            setTheme(getPreferredTheme());

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector("#bd-theme");

                if (!themeSwitcher) {
                    return;
                }

                const themeSwitcherText = document.querySelector("#bd-theme-text");
                const activeThemeIcon = document.querySelector(".theme-icon-active");
                const btnToActive = document.querySelector(
                    `[data-bs-theme-value="${theme}"] i`
                );
                document
                    .querySelectorAll("[data-bs-theme-value]")
                    .forEach((element) => {
                        element.classList.remove("active");
                        element.setAttribute("aria-pressed", "false");
                    });

                activeThemeIcon.classList.remove(activeThemeIcon.classList[2]);
                activeThemeIcon.classList.add(btnToActive.classList[1]);

                btnToActive.classList.add("active");
                btnToActive.setAttribute("aria-pressed", "true");
                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
                themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

                if (focus) {
                    themeSwitcher.focus();
                }
            };

            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addEventListener("change", () => {
                    const storedTheme = getStoredTheme();
                    if (storedTheme !== "light" && storedTheme !== "dark") {
                        setTheme(getPreferredTheme());
                    }
                });

            window.addEventListener("DOMContentLoaded", () => {
                showActiveTheme(getPreferredTheme());

                document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
                    toggle.addEventListener("click", () => {
                        const theme = toggle.getAttribute("data-bs-theme-value");
                        setStoredTheme(theme);
                        setTheme(theme);
                        showActiveTheme(theme, true);
                    });
                });
            });
        })();
    </script>
</body>

</html>
