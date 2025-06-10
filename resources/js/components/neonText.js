export default function neonText() {
    return {
        init() {
            const textElements = [this.$refs.text, this.$refs.text2];

            textElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    gsap.to(el, {
                        textShadow: '0 0 5px currentColor, 0 0 10px currentColor, 0 0 20px currentColor',
                        duration: 0.3
                    });
                });

                el.addEventListener('mouseleave', () => {
                    gsap.to(el, {
                        textShadow: 'none',
                        duration: 0.3
                    });
                });
            });
        }
    };
}
