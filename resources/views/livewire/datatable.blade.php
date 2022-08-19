<div>

    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Search users...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="sortField" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="created_at">Sign Up Date</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="sortAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value='1' selected>status</option>
                <option value="admin">admin</option>
                <option value="super admin">super admin</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="10">10</option>
                @if ($usercount > 25)
                <option value="25">25</option>
                @endif
                @if ($usercount > 50)
                <option value="50">50</option>

                @endif
                @if ($usercount > 100)
                <option value="100">100</option>

                @endif
                <option value="{{ $usercount }}">show all users</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <button wire:click="deleteUsers" class="hover:bg-indigo-500 block appearance-none w-full bg-red-500 border border-gray-200 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500">Delete</button>
        </div>
    </div>
    <div class="w-1/6 mx-1 block">
        {{ $perPage }} User of :  {{ $usercount }}
    </div>
        @if($users->isNotEmpty())
            <table class="table-auto w-full mb-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2"></th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">status</th>
                        <th class="px-4 py-2">Created At</th>
                        <th class="px-4 py-2">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2">
                                <input wire:model="selected" value="{{ $user->id }}" type="checkbox">
                            </td>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->status }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="border px-4 py-2">
                              <button wire:click="deleteuser({{ $user->id }})" class="block appearance-none w-full bg-red-500 border border-gray-200 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none hover:bg-red-900 focus:border-gray-500">Delete</button>
                              <button  wire:click="edituser({{ $user->id }})"  type="button" data-toggle="modal" data-target="#myModal" class="block appearance-none w-full bg-indigo-500 border border-gray-200 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none hover:bg-indigo-900 focus:border-gray-500">edit</button>

<!-- Modal toggle -->

</td>
</tr>
@endforeach


</tbody>
</table>
{!! $users->links() !!}
@else
<p class="text-center">Whoops! No users were found 🙁</p>
@endif
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit user</h4>
        </div>
        <div class="modal-body">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input required wire:model="name" value='{{ $user_name }}' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    status
                </label>
                <input required wire:model="new_status" value='{{ $user_name }}' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="flex items-center justify-between">
                <button data-dismiss="modal" wire:click='edit()' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                   edit
                </button>

                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
