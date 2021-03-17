@if ($errors->any())
<div class="{{ $errors->any() ? 'bg-red-100 ': 'bg-green-100' }}
    border-l-4
    {{ $errors->any() ? 'border-red-500 ': 'border-green-500' }}
    {{ $errors->any() ? 'text-red-700 ': 'text-green-700' }}
    p-4
    relative" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button class="absolute
    bg-transparent
    text-2xl
    font-semibold
    leading-none
    right-0
    top-0
    mt-4
    mr-6
    outline-none
    focus:outline-none" onclick="closeAlert(event)">
        <span>×</span>
  </div>
@endif
<script>
    function closeAlert(event){
      let element = event.target;
      while(element.nodeName !== "BUTTON"){
        element = element.parentNode;
      }
      element.parentNode.parentNode.removeChild(element.parentNode);
    }
  </script>
