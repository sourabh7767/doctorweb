if (button.hasClass('active')) {
                            if (lineCount > 1) {
                               
                                description.split(/\r\n|\r|\n/).forEach(function (line) {
                                    console.log(line);
                                    if (line.trim() !== '') {
                                        textarea.value = textarea.value.replace(line + '\n', '');
                                    }
                                    // console.log(textarea.value);
                                });
                            } else {
                                description.split(/\r\n|\r|\n/).forEach(function (line) {
                                    console.log(line);
                                    if (line.trim() !== '') {
                                        textarea.value = textarea.value.replace(line + '\n', '');
                                    }
                                    // console.log(textarea.value);
                                });

                                 
                                    // textarea.value = textarea.value.replace(regex, '');
                                    // textarea.value = textarea.value.replace(/\n/g, '');
                                // textarea.value = textarea.value.replace(description + '\n');
                            }
                            button.removeClass('active');
                        } else {
                                textarea.value = textarea.value + description + '\n';
                                button.addClass('active');
                        }