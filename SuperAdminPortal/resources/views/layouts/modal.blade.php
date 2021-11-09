<div  class="z-40 hidden items-center transition ease-in duration-150 h-screen bg-black bg-opacity-50 absolute inset-0  justify-center items-center" id="overlay">
    <div class="  bg-darkAsh-200 h-2/2 relative top-0  w-1/2  py-3 px-2 mb-0 rounded shadow-2xl text-gray-800">
   <div class=" flex-col items-center px-2 mb-0">

        <div class=" flex justify-between justify-center py-2">
        <h2 class=" text-lg font-bold text-gray-100 flex mx-auto items-center">Crop Image</h2>
        <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full transition ease-in duration-150" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
             </svg>
          </div>
          <div class="loading hidden w-full  transition ease-in duration-300 z-20 left-40 opacity-50 top-40 mx-auto h-20  bg-darkAsh-100 flex items-center justify-center rounded">
                <h1 class="text-lg text-gray-100 ">Croping...</h1>
          </div>
          <div class=" mt-2 text-lg flex mx-auto">
               <div class="img-container w-full px-1 flex justify-between  items-center">
                    <div class="w-1/2 ">  
                        <img id="image">
                    </div>
                        <div class="preview rounded-full">
                        </div>
                    </div>
            </div>
       

           <div class=" mt-3 flex justify-end space-x-3 ">
               <button onclick="cropingImage('{{route('userImage')}}', '{{ auth()->user()->id ?? 0}}')" class=" py-1 px-3 bg-green-500 text-gray-200 rounded hover:bg-green-400 hover:text-gray-100 ">Crop</button>
               <button onclick="skipCrop()" class="py-1 px-3 bg-blue-500 text-gray-200 rounded hover:bg-blue-300 hover:text-gray-100">skip</button>
               <button onclick="cancelCrop()" class="py-1 px-3 bg-gray-200 text-gray-500 rounded hover:bg-gray-400 hover:text-gray-100">Cancel</button>
           </div>
           {{-- <img src="" alt="" srcset="" id="profileUpload2" class="newimage"> --}}
   </div>
</div>

</div>

<style>
    .preview {
    overflow: hidden;
    width: 170px; 
    height: 170px;
   }

   </style>