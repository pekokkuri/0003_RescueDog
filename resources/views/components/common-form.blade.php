<fieldset class="border border-gray-400 rounded mx-auto border-double rounded-lg w-[700px] h-[500px] ">
  <legend class="text-gray-500 text-sm px-2 text-center">
    {{ $formTitle }}
  </legend>

  <form id="post-form" method="{{ $formMethod }}" action="{{ $formAction }}" enctype="multipart/form-data" class="max-w-xl">
      @csrf
      @if ($formMethod === 'PUT')
        @method('PUT')
      @elseif ($formMethod === 'PATCH')
        @method('PATCH')
      @endif
      
      {{ $slot }}

      <div class="m-4">
          <label>
              場所：
              <input 
                type="text"
                name="address"
                id="address"
                class="w-[500px] h-[30px]" 
                value="{{ old('address', isset($post) ? $post->address : '') }}"/>
          </label>
            <input type="hidden" name="lat" id="lat" value="{{ old('lat', isset($post) ? $post->lat : '') }}"/>
            <input type="hidden" name="lng" id="lng" value="{{ old('lng', isset($post) ? $post->lng : '') }}"/>
          </label>

          <div id="error-message"></div>
      </div>
      <!-- <div>
          <label>
              特徴
              <textarea></textarea>
          </label>
      </div> -->
  </form>

  <!----------------
      ボタン
   ---------------->
  <div class="flex justify-end gap-4 mt-6 mr-4">
      <div>
          <button type="button" onclick="submitForm()" class="bg-blue-800 hover:bg-blue-700 text-white text-center rounded px-4 py-2">
              {{ $submitLabel }}
          </button>
      </div>
      <a href="{{ $backLink }}">
          <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
              戻る
          </button>
      </a>
  </div>
</fieldset>

<script
  src="https://maps.googleapis.com/maps/api/js?key={{
      config('services.google_maps.api_key')
  }}"
  async
  defer
></script>
<script src="{{ url('/js/geo.js') }}"></script>