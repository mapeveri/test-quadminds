import { createLocalVue, mount } from '@vue/test-utils';
import VueRouter from 'vue-router';
import expect from 'expect';
import ShowNote from '../../../resources/js/views/ShowNote.vue';
import router from '../../../resources/js/routes';

describe('ShowNote.vue', () => {
  let component;

  beforeEach(() => {
    const localVue = createLocalVue();
    localVue.use(VueRouter);

    component = mount(ShowNote, {
        attachToDocument: true,
        localVue,
        router
    });
  });

  it('contains ShowNote', () => {
    expect(component.vm.$route).toBeInstanceOf(Object);
    expect(component.find('h1').text()).toBe('Note');
    expect(component.find('a').text()).toBe('Back');
    expect(component.find('p').text()).toBe('Title:');
  });

});
