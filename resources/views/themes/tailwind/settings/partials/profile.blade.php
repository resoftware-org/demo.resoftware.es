<form action="{{ route('wave.settings.profile.put') }}" method="POST" enctype="multipart/form-data">
  <div class="relative flex flex-col px-10 py-8 lg:flex-row">
    <div class="flex justify-start w-full mb-8 lg:w-3/12 xl:w-1/5 lg:m-b0">
      <div class="relative w-32 h-32 cursor-pointer group">
        <img id="preview" src="{{ Voyager::image(auth()->user()->avatar) . '?' . time() }}" class="w-32 h-32 rounded-full ">
        <div class="absolute inset-0 w-full h-full">
            <input type="file" id="upload" class="absolute inset-0 z-20 w-full h-full opacity-0 cursor-pointer group">
            <input type="hidden" id="uploadBase64" name="avatar">
            <button class="absolute bottom-0 z-10 flex items-center justify-center w-10 h-10 mb-2 -ml-5 bg-black bg-opacity-75 rounded-full opacity-75 group-hover:opacity-100 left-1/2">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          </button>
        </div>
      </div>
    </div>
    <div class="w-full lg:w-9/12 xl:w-4/5">
      <div>
        <label for="name" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_name')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          <input id="name" type="text" name="name" placeholder="Name" value="{{ Auth::user()->name }}" required class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_email_address')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          <input id="email" type="text" name="email" placeholder="Email Address" value="{{ Auth::user()->email }}" required class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="about" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_about')}}</label>
        <div class="mt-1 rounded-md">
          {!! profile_field('text_area', 'about') !!}
        </div>
      </div>

      <div class="mt-5">
        <label for="date_of_birth" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_date_of_birth')}}</label>
        <div class="mt-1 rounded-md">
          {!! profile_field('date', 'date_of_birth') !!}
        </div>
      </div>

      <div class="flex flex-col mt-5 lg:flex-row">
        <div class="w-full lg:w-1/2">
          <label for="gender" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_gender')}}</label>
          <div class="mt-1 rounded-md">
          {!! profile_field('hidden', 'gender') !!}

          <select class="form-control select2" name="gender">
            <option value="m" {{ Auth::user()->profile("gender") === "m" ? "selected" : "" }} >{{__("replay.profile.form.gender_m")}}</option>
            <option value="f" {{ Auth::user()->profile("gender") === "f" ? "selected" : "" }} >{{__("replay.profile.form.gender_f")}}</option>
            <option value="0" {{ Auth::user()->profile("gender") === "0" ? "selected" : "" }} >{{__("replay.profile.form.gender_0")}}</option>
          </select>
          </div>
        </div>

        <div class="w-full lg:w-1/2 lg:ml-4">
          <label for="title" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_title')}}</label>
          <div class="mt-1 rounded-md">
          {!! profile_field('hidden', 'title') !!}

          <select class="form-control select2" name="title">
            <option value="0" {{ Auth::user()->profile("title") === "0" ? "selected" : "" }} >{{__("replay.profile.form.title_none")}}</option>
            <option value="Mr." {{ Auth::user()->profile("title") === "Mr." ? "selected" : "" }} >{{__("replay.profile.form.title_mr")}}</option>
            <option value="Ms." {{ Auth::user()->profile("title") === "Ms." ? "selected" : "" }} >{{__("replay.profile.form.title_ms")}}</option>
            <option value="Mrs." {{ Auth::user()->profile("title") === "Mrs." ? "selected" : "" }} >{{__("replay.profile.form.title_mrs")}}</option>
            <option value="Sir" {{ Auth::user()->profile("title") === "Sir" ? "selected" : "" }} >{{__("replay.profile.form.title_sir")}}</option>
            <option value="Dr." {{ Auth::user()->profile("title") === "Dr." ? "selected" : "" }} >{{__("replay.profile.form.title_dr")}}</option>
            <option value="Prof." {{ Auth::user()->profile("title") === "Prof." ? "selected" : "" }} >{{__("replay.profile.form.title_prof")}}</option>
          </select>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <label for="website_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_website')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'website_url') !!}
          <input
            id="website_url"
            type="text"
            name="website_url"
            placeholder="{{__('replay.profile.form.placeholder_website_url')}}"
            value="{{ Auth::user()->profile('website_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="facebook_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_facebook')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'facebook_url') !!}
          <input
            id="facebook_url"
            type="text"
            name="facebook_url"
            placeholder="{{__('replay.profile.form.placeholder_facebook_url')}}"
            value="{{ Auth::user()->profile('facebook_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="instagram_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_instagram')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'instagram_url') !!}
          <input
            id="instagram_url"
            type="text"
            name="instagram_url"
            placeholder="{{__('replay.profile.form.placeholder_instagram_url')}}"
            value="{{ Auth::user()->profile('instagram_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="twitter_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_twitter')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'twitter_url') !!}
          <input
            id="twitter_url"
            type="text"
            name="twitter_url"
            placeholder="{{__('replay.profile.form.placeholder_twitter_url')}}"
            value="{{ Auth::user()->profile('twitter_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="twitch_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_twitch')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'twitch_url') !!}
          <input
            id="twitch_url"
            type="text"
            name="twitch_url"
            placeholder="{{__('replay.profile.form.placeholder_twitch_url')}}"
            value="{{ Auth::user()->profile('twitch_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="mt-5">
        <label for="youtube_url" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.form.label_youtube')}}</label>
        <div class="mt-1 rounded-md shadow-sm">
          {!! profile_field('hidden', 'youtube_url') !!}
          <input
            id="youtube_url"
            type="text"
            name="youtube_url"
            placeholder="{{__('replay.profile.form.placeholder_youtube_url')}}"
            value="{{ Auth::user()->profile('youtube_url') }}"
            class="w-full form-input">
        </div>
      </div>

      <div class="flex justify-end w-full">
        <button class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-wave-700" dusk="update-profile-button">Save</button>
      </div>
    </div>
  </div>

  {{ csrf_field() }}



</form>

<div id="uploadModal" x-data x-init="$watch('$store.uploadModal.open', value => {
      if (value === true) { document.body.classList.add('overflow-hidden') }
      else { document.body.classList.remove('overflow-hidden'); clearInputField(); }
    });" x-show="$store.uploadModal.open" class="fixed inset-0 z-10 z-30 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$store.uploadModal.open" @click="$store.uploadModal.open = false;" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div x-show="$store.uploadModal.open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-cloak>
            <div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
						Position and resize your photo
                    </h3>
                    <div class="mt-2">
						<div id="upload-crop-container" class="relative flex items-center justify-center h-56 mt-5">
							<div id="uploadLoading" class="flex items-center justify-center w-full h-full">
								<svg class="w-5 h-5 mr-3 -ml-1 text-gray-400 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
									<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
								</svg>
							</div>
							<div id="upload-crop"></div>
						</div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <span class="flex w-full rounded-md shadow-sm">
					<button @click="$store.uploadModal.open = false;" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">Cancel</button>
            		<button @click="$store.uploadModal.open = false; window.applyImageCrop()" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-wave-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave sm:text-sm sm:leading-5" id="apply-crop" type="button">Apply</button>
                </span>
            </div>
        </div>
    </div>
</div>
