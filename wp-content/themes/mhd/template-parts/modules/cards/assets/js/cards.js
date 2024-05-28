// MandrSliderScrollClass();

// function MandrSliderScrollClass() {
//     console.log('here');
//     const sliderSection = document.querySelector('.slider-scroll');
//     const breakpoint = 1024;
//     class Slider {
//         constructor(sliderSection) {
//             this.sliderSection = sliderSection;
//             this.scrollContainer = null;
//             this.scrollContent = null;
//             this.mousePadded = 0;
//             this.curPos = 0;
//             this.isResponsive = false;
//             this.scrollIntervalId = null;
//         }
//         get containerBounds() {
//             return this.scrollContainer.getBoundingClientRect();
//         }
//         get contentWidth() {
//             return this.contentBounds.width;
//         }
//         get contentBounds() {
//             return this.scrollContent.getBoundingClientRect();
//         }
//         get containerLeft() {
//             return Math.floor(this.containerBounds.left);
//         }
//         get diff() {
//             return this.contentScrollWidth / this.contentWidth - 1;
//         }
//         get mouseArea() {
//             return this.contentWidth / (this.contentWidth - 120);
//         }
//         get contentScrollWidth() {
//             return this.scrollContent.scrollWidth;
//         }

//         init() {
//             this.scrollContainer =
//                 this.sliderSection.querySelector('.slider-container');
//             this.scrollContent =
//                 this.sliderSection.querySelector('.slider-content');

//             this.loadSlider();
//         }

//         loadSlider() {
//             clearInterval(this.scrollIntervalId);
//             this.removeEventHandlers();

//             if (this.isResponsive == true) {
//                 this.scrollContent.style.transform = `translate(0px, 0)`;
//             } else {
//                 this.addEventHandlers();
//             }
//         }

//         updateSliderScrollPos(e) {
//             const currentLeftOffset =
//                 this.scrollContent.getBoundingClientRect().left -
//                 window.scrollX;
//             const containerOffset = this.containerLeft - window.scrollX;
//             const curMousePos = e.pageX - containerOffset - currentLeftOffset;

//             this.mousePadded =
//                 Math.min(
//                     Math.max(0, curMousePos - 60),
//                     this.contentWidth - 120
//                 ) * this.mouseArea;
//         }

//         setScrollPosition() {
//             this.scrollIntervalId = setInterval(() => {
//                 this.curPos += (this.mousePadded - this.curPos) / 50;
//                 this.scrollContent.style.transform = `translate(-${
//                     this.curPos * this.diff
//                 }px, 0)`;
//             }, 10);
//         }

//         addEventHandlers() {
//             this.scrollContent.addEventListener(
//                 'mousemove',
//                 this.updateSliderScrollPos.bind(this)
//             );
//             this.scrollContent.addEventListener(
//                 'mouseenter',
//                 this.setScrollPosition.bind(this)
//             );
//         }
//         removeEventHandlers() {
//             this.scrollContent.removeEventListener(
//                 'mousemove',
//                 this.updateSliderScrollPos.bind(this)
//             );
//             this.scrollContent.removeEventListener(
//                 'mouseenter',
//                 this.setScrollPosition.bind(this)
//             );
//         }
//     }

//     if (!sliderSection || typeof sliderSection === 'undefined') return;

//     let slider = new Slider(sliderSection);

//     window.addEventListener('resize', () => {
//         slider.isResponsive = window.innerWidth < breakpoint;

//         if (slider.isResponsive == true) {
//             slider.loadSlider();
//         }
//     });
//     window.addEventListener('load', () => {
//         slider.isResponsive = window.innerWidth < breakpoint;
//         slider.init();
//     });
// }
