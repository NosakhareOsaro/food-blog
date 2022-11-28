<div class="container mx-auto mt-2">
    <x-jet-banner />
     <div class="flex content-center p-2 m-2">
         <x-jet-button wire:click="showCreatePostModal" class="bg-green-500">Create Post</x-jet-button>
     </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
   <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
     <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
       <table class="min-w-full divide-y divide-gray-200">
         <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
           <tr>
             <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
             <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Title</th>
             <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
             <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Image</th>
             <th scope="col" class="relative px-6 py-3">Edit</th>
           </tr>
         </thead>
         <tbody class="bg-white divide-y divide-gray-200">
           <tr></tr>
           @foreach($posts as $post)
           <tr>
             <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
             <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
             <td class="px-6 py-4 whitespace-nowrap">
               @if($post->active )
               active
               @else
               Not active
               @endif
             </td>
             <td class="px-6 py-4 whitespace-nowrap">
               <img class="w-8 h-8 rounded-full" src="/storage/photos/{{ $post->image }}" />
             </td>
             <td class="px-6 py-4 text-sm text-right">
               <x-jet-button wire:click="showEditPostModal({{ $post->id }})" class="bg-green-500">Edit</x-jet-button>
               <x-jet-button wire:click="deletePost({{ $post->id}})" class="bg-red-700">Delete</x-jet-button>
             </td>
           </tr>
           @endforeach
           <!-- More items... -->
         </tbody>
       </table>
       <div class="p-2 m-2">
         {{ $posts->links() }}
       </div>
     </div>
   </div>
 </div>
  <x-jet-dialog-modal wire:model="showModalForm">
      <x-slot name="title">Create Post</x-slot>
      <x-slot name="content">
        <div class="w-1/2 mt-10 space-y-8 divide-y divide-gray-200">
   <form enctype="multipart/form-data">
     <div class="sm:col-span-6">
       <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
       <div class="mt-1">
         <input type="text" id="title" wire:model.lazy="title" name="title" class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5" />
       </div>
           @error('title') <span class="error">{{ $message }}</span> @enderror
     </div>
     <div class="sm:col-span-6">
       <div class="w-full p-2 m-2">
         @if ($newImage)
          Post Photo:
         <img src="{{ asset('storage/photos/'. $newImage ) }}">
         @endif
         @if ($image)
         Photo Preview:
         <img src="{{ $image->temporaryUrl() }}">
         @endif
       </div>
       <label for="title" class="block text-sm font-medium text-gray-700"> Post Image </label>
       <div class="mt-1">
         <input type="file" id="image" wire:model="image" name="image" class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5" />
       </div>
           @error('image') <span class="error">{{ $message }}</span> @enderror
     </div>
     <div class="pt-5 sm:col-span-6">
       <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
       <div class="mt-1">
         <textarea id="body" rows="3" wire:model.lazy="body" class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-300 border-gray-400 rounded-md shadow-sm appearance-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
       </div>
           @error('body') <span class="error">{{ $message }}</span> @enderror
     </div>
   </form>
 </div>
      </x-slot>
      <x-slot name="footer">
        <x-jet-button wire:click="cancel">Cancel</x-jet-button>
        @if($postId)
        <x-jet-button wire:click="updatePost">Update</x-jet-button>
        @else
        <x-jet-button wire:click="storePost">Store</x-jet-button>
        @endif
      </x-slot>
  </x-jet-dialog-modal>
 </div>