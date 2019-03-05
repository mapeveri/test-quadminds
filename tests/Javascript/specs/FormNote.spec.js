import { createLocalVue, mount } from '@vue/test-utils';
import VueRouter from 'vue-router';
import expect from 'expect';
import FormNote from '../../../resources/js/views/FormNote.vue';
import router from '../../../resources/js/routes';

const localVue = createLocalVue();
localVue.use(VueRouter);

describe('FormNote.vue', () => {
  let component;

  beforeEach(() => {
    component = mount(FormNote, {
        attachToDocument: true,
        localVue,
        router
    });
  });

  it('contains FormNote', () => {
    expect(component.vm.$route).toBeInstanceOf(Object);
    expect(component.find('label').text()).toBe('Title');
    expect(component.find('button').text()).toBe('Save');
    expect(component.find('a').text()).toBe('Back');
  });

});
