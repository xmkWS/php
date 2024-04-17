// slider start

const dots = document.querySelectorAll('.dot')
const slides = document.querySelectorAll('.slide')

dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
        slides.forEach(slide => {
            slide.classList.remove('active')
        })
        dots.forEach(dot => {
            dot.classList.remove('active')
        })
        slides[i].classList.add('active')
        dot.classList.add('active')
    })
})

// slider end

// faq start

const accEl = document.querySelectorAll('.accordion')
const accButton = document.querySelectorAll('.accordion-button')

accButton.forEach((button, index) => {
    
    const accordion = accEl[index]

    button.addEventListener('click', () => {
        accordion.classList.toggle('show')

        if(accordion.classList.contains('show')){
            button.style.transform = 'rotate(90deg)'
        } else {
            button.style.transform = 'rotate(0deg)'
        }

    }) 

})

// faq end