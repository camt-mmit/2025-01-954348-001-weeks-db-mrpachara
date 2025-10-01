<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai+Looped:wght@100..900&family=Roboto+Flex:opsz,wdth,wght,GRAD@8..144,25..151,100..1000,-200..150&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-25..200&display=block" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" />

    <title>Login</title>
</head>

<body>
    <main id="app-cmp-main-content" style="width: min(400px, 100%);">
        <header>
            <h1>Login</h1>
        </header>

        <form action="{{ route('authenticate') }}" method="post">
            @csrf

            <div class="app-cmp-form-detail">
                <label for="app-inp-email">Email</label>
                <input type="email" id="app-inp-email" name="email" required />
                @error('email')
                    <span></span>
                    <span class="app-cl-warn">{{ $message }}</span>
                @enderror

                <label for="app-inp-password">Password</label>
                <input type="password" id="app-inp-password" name="password" required />
                @error('password')
                    <span></span>
                    <span class="app-cl-warn">{{ $message }}</span>
                @enderror
            </div>

            <div class="app-cmp-form-actions">
                <button type="submit" class="app-cl-primary app-cl-filled">
                    <i class="material-symbols-outlined">login</i>
                    Login
                </button>
            </div>

            <div class="app-cmp-notifications" style="margin-top: 1em;">
                @error('credentials')
                    <div role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </form>
    </main>

    <footer id="app-cmp-main-footer">
        &#xA9; Copyright Pachara's Database.
    </footer>
</body>

</html>
