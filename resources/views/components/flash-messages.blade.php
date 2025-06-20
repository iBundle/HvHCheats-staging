@if(session('success'))
    <div class="flash-message flash-message--success" x-data="{ show: true }" x-show="show" x-transition>
        <div class="flash-message__content">
            <i class="fa-solid fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="flash-message__close">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="flash-message flash-message--error" x-data="{ show: true }" x-show="show" x-transition>
        <div class="flash-message__content">
            <i class="fa-solid fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="flash-message__close">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="flash-message flash-message--error" x-data="{ show: true }" x-show="show" x-transition>
        <div class="flash-message__content">
            <i class="fa-solid fa-exclamation-triangle"></i>
            <div>
                <strong>Исправьте ошибки:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button @click="show = false" class="flash-message__close">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
@endif

<style>
    .flash-message {
        position: fixed;
        top: 2rem;
        right: 2rem;
        z-index: 9999;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        max-width: 400px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .flash-message--success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .flash-message--error {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .flash-message__content {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        flex: 1;
    }

    .flash-message__content i {
        font-size: 1.25rem;
        margin-top: 0.125rem;
        flex-shrink: 0;
    }

    .flash-message__content ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1rem;
    }

    .flash-message__content li {
        margin-bottom: 0.25rem;
    }

    .flash-message__close {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .flash-message__close:hover {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .flash-message {
            top: 1rem;
            right: 1rem;
            left: 1rem;
            max-width: none;
        }
    }
</style>