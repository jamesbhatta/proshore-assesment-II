<template>
  <div class="flex">
    <div class="flex-shrink-0 p-5 bg-indigo-900 bg-opacity-90 h-screen" style="min-width: 200px">
      <nav class="py-2 md:mt-8">
        <ul class="sidenav justify-center space-y-2 pl-2">
          <li class="nav-item">
            <router-link to="/">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                ></path>
              </svg>
              <span>Events</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'events.create' }">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              <span>Add New</span>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
    <div class="flex-grow">
      <!-- <div v-if="isLogged" class="px-4 py-5 bg-white border-b text-right">
        <div class="inline-flex space-x-2">
          <img class="w-6 h-6 rounded-full" :src="authUser.user.avatar_url" :alt="authUser.user.name" />
          <span>{{ authUser.user.name }}</span>
        </div>
      </div> -->
      <router-view class="p-6"></router-view>
      <notifications />
    </div>
  </div>
</template>