@php
  $photo = $user->profile_photo_path ?? null;
  $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
@endphp

@if($photo)
  <img src="{{ asset('storage/' . $photo) }}" alt="Avatar" class="{{ $attributes->get('class') }}">
@else
  <div class="avatar-placeholder {{ $attributes->get('class') }}" style="display:inline-flex;align-items:center;justify-content:center;background:#ccc;border-radius:50%;font-weight:bold;">
    {{ $initial }}
  </div>
@endif
