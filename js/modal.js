let openModal=document.querySelector("#menu-item-24");
let modal = document.querySelector("#myModal")



openModal.addEventListener('click',()=>{
    modal.style.display='flex';
    
})


document.addEventListener('mouseup',(e)=>{
    let obj = document.querySelector('.container');
    if(!obj.contains(e.target)){
        modal.style.display='none';
    }
})

//modal des pages de posts
let modalSinglePost= document.querySelector('#myModal_single_post')
let postContactButton = document.querySelector(".post-contact-button")

postContactButton.addEventListener('click',()=>{
    modalSinglePost.style.display='flex';
    
})

document.addEventListener('mouseup',(e)=>{
    let obj = document.querySelector('.container_single_post');
    if(!obj.contains(e.target)){
        modalSinglePost.style.display='none';
    }
})

