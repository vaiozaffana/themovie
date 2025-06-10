export default function typingAnimation() {
    return {
        init(text, speed) {
            const element = this.$el;
            let i = 0;

            function typeWriter() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }

            typeWriter();
        }
    };
}
